<?php


namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Facades\Route;
use Session;
use Auth;
class BooksController extends Controller
{
    //
 protected $bk;
//protected $loaibanh;
public function create()
    {
        return view('books.create');
    }
public function store(AddProductRequest $req)
    {
	$book = new Product();
	$book ->name = $req ->name;

$book ->id_type = $req ->id_type;
$book ->description = $req ->description;
$book ->unit_price = $req ->unit_price;
$book ->promotion_price = $req ->promotion_price;
$book ->image = $req ->image->getClientOriginalName();
$book ->unit = "cuốn";
$book -> new = 1;



       $book->save();
        return redirect()->back()->with('thanhcong','Tạo thành công');

       // return redirect()->route('books.index');
    }

   public function destroy($id)
    {
      Product::destroy($id);

        return redirect()->route('trang-chu');
    }

public function edit($id)
    {
$data = Product::find($id);
        return view('books.edit',compact('data'));
    }

public function editPost(Request $req,$id)
    {
//Product::destroy($id);
	//$book = new Product();
	$book = new Product();
	$arr['name'] = $req ->name;

$arr['id_type'] = $req ->id_type;
$arr['description'] = $req ->description;
$arr['unit_price'] = $req ->unit_price;
$arr['promotion_price'] = $req ->promotion_price;
$arr['image'] = $req ->image->getClientOriginalName();
$arr['unit'] = "cuốn";
$arr['new'] = 1;
$book::where('id',$id)->update($arr);

        return redirect()->route('trang-chu');
 //return redirect()->route('trang-chu');

    }
}
