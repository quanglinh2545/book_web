<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\User;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Session;
use Auth;
class PageController extends Controller
{
    //
    public function getIndex(){
        $slide = Slide::all();
        $new_product =  Product::where('new',1)->paginate(4);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(4);
        //dd($new_product);
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
        //return view('page.trangchu')->with($sanpham_khuyenmai);
    }
    public function getLoaiSp($type){
        $loai = ProductType::all();
       $sp_theoloai = Product::where('id_type',$type) ->get();
       $sp_khac = Product::where('id_type','<>',$type)->paginate(4);
       $loai_sp = ProductType::where('id',$type)->first();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }
    public function getChitiet(Request $req){
    	$sanpham = Product::where('id',$req->id)->first();
    	$sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);
    	$new_prod = Product::where('new',1)->take(4)->get();
    	//$best_seller = Bill::where('id','>',0)->get();
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','new_prod'));
    }
    public function getLienHe(){
        return view('page.lienhe');
    }
    public function getGioiThieu(){
        return view('page.gioithieu');
    }
  
    public function getLogin(){
        return view('page.dangnhap');
    }
    public function getSignin(){
        return view('page.dangki');
    }
    public function postSignin(Request $req){
        $this -> validate($req,
            [
                'email' => 'required|email|unique:users,email',
                'password' =>'required|min:6|max:20',
                'fullname' =>'required',
                're_password' => 'required|same:password'
            ]
        );
        $user = new User();
        $user ->full_name = $req ->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');

    }
    public function postLognin(Request $req){
        $this -> validate($req,
        [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if (Auth::attempt($credentials)) {
            //     return redirect()->back()->with('thanhcong','Đăng nhập thành công');
        // }
        // else{
        //     return redirect()->back()->with('thatbai','Đăng nhập thất bại');
        // }
        return redirect()->route('trang-chu');
        }
        else{
                return redirect()->back()->with('thatbai','Đăng nhập thất bại');
            }
    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')->get();
        return view('page.search',compact('product'));
    }
    public function getAddToCart(Request $res,$id){//dùng request để gán cart vào sesion
    	$product = Product::find($id);//co id cua san phẩm hay k
        $oldCart = Session('cart')?Session::get('cart'):null;//kiểm tra xem session hiện tại
        //đã có sản phâm đang mua hay không
    	$cart = new Cart($oldCart);//Thêm sản phẩm đó vào danh sách sản phẩm cũ
        $cart->add($product, $id);//gọi phương thưc thêm vào giỏ hàng

		$res->session()->put('cart',$cart);//sử dụng session để put vào giỏ hàng
		return redirect()->back();//trở về trang chủ
    }

    public function getDelItemCart($id){
    	$oldCart = Session::has('cart')?Session::get('cart'):null;
    	 $cart = new Cart($oldCart);
         $cart->removeItem($id);

    	 if(count($cart->items)>0){
    	 	Session::put('cart', $cart);
    	 }
    	 else{
    	 	Session::forget('cart');
    	 }
    	 return redirect()->back();
    }

    public function getCheckout(){
    	return view('page.dat_hang');
    }

    public function postCheckout(Request $res){
    	$cart = Session::get('cart');
    	$customer = new Customer();
    	$customer->name = $res->name;
    	$customer->gender = $res->gender;
    	$customer->email = $res->email;
    	$customer->address = $res->address;
    	$customer->phone_number = $res->phone;
    	$customer->note = $res->notes;
    	$customer->save();

    	$bill = new Bill();
    	$bill->id_customer = $customer->id;
    	$bill->date_order = date('Y-m-d');
    	$bill->total = $cart->totalPrice;
    	$bill->payment = $res->payment_method;
    	$bill->note = $res->notes;
    	$bill->save();

    	foreach ($cart->items as $key => $value) {
    		$bill_detail = new BillDetail();
    		$bill_detail->id_bill = $bill->id;
    		$bill_detail->id_product = $key;
    		$bill_detail->quantity = $value['qty'];
    		$bill_detail->unit_price = ($value['price']/$value['qty']);
    		$bill_detail->save();
    	}
    	Session::forget('cart');
    	return redirect()->back()->with('thongbao','Đặt hàng thành công');

    }
    
  
}
