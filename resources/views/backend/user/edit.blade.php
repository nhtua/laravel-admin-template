@extends('layouts.backend')

@section('title','Chỉnh sửa')

@section('content')
	<div class="page-title">
      <div class="title_left">
        @include('common.breadcrumb', ['links'=>[
          [route('backend::user.home'),'Quản lý User'],
        ],'current'=> $user->name])
      </div>
      <div class="title_right">
          <div class="col-md-2 col-sm-2 col-xs-4 form-group pull-right top_search">
              <div class="input-group">
                 <a href="{{route('backend::user.add')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm tài khoản</a>
              </div>
          </div>
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