	@extends('master')
@section('content')
    <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="{{route('loginPost')}}" method="post" class="beta-form-checkout">
			@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					 @if(count($errors) >0)
                        <div class = "alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}}
                        @endforeach
                        </div>
                    @endif
                    @if(Session::has('thanhcong'));
                    <div class = "alert alert-success">{{Session::get('thanhcong')}}</div>
					@else
					 <div class = "alert alert-danger">{{Session::get('thatbai')}}</div>
                    @endif

					<div class="col-sm-6">

						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" name ="email" required>
						</div>
						<div class="form-block">
							<label for="phone">Password*</label>
							<input type="password" name ="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
    @endsection