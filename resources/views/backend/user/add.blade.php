@extends('layouts.backend')

@section('title','Thêm tài khoản')

@section('content')
	<div class="page-title">
      <div class="title_left">
          @include('common.breadcrumb', ['links'=>[
            [route('backend::user.home'),'Quản lý User'],
          ],'current'=> 'Thêm tài khoản'])
      </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
 		<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
				@include('backend.user.form') 
			</div>
		</div> 	
  </div>
@endsection