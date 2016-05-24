@extends('layouts.backend')

@section('title','Cập nhật thông tin tài khoản')

@section('content')
  <div class="page-title">
      <div class="title_left">
          @include('common.breadcrumb', ['links'=>[
          ],'current'=> 'Cập nhật thông tin tài khoản'])
      </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <?php 
          $labels = $user->getLabels();
          $messageBag = $errors->getBag('default');
        ?>

        <div class="x_title">
            <h2>{{$user->name or 'Thêm tài khoản'}}</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form method="POST" action="{{route('backend::user.updateProfile')}}"  enctype="multipart/form-data" id="UserForm" class="form-horizontal form-label-left">
                
                @include('common.flash')

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="id" value="{{{ $user->id }}}" />
                
                <div class="form-group {{ $messageBag->has('avatar') ? 'has-error' : ''}}">
                  <label for="Article_avatar" class="control-label col-md-3 col-sm-3 col-xs-12">{{$labels['avatar']}} </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="{{$user->getThumbBySize(128,'avatar')}}" width="128">
                    <input type="file" id="User_avatar" name="avatar">
                    <p class="help-block">Ảnh nhỏ hơn 3MB</p>
                    @if($user->id != '')
                    <input type="checkbox" id="User_avatar_remove" name="avatar_remove"><label for="User_avatar_remove">Xóa ảnh hiện tại </label>
                    @endif
                  </div>
                </div>  
                <div class="form-group {{ $messageBag->has('name') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_name">{{$labels['name']}} <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="User_name" name="name"  required="required" class="form-control col-md-7 col-xs-12" value="{{$user->name or old('name')}}">
                  </div>
                </div>
                <div class="form-group {{ $messageBag->has('email') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_email">{{$labels['email']}} <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="User_email" name="email"  required="required" class="form-control col-md-7 col-xs-12" value="{{ $user->email or old('email') }}">
                  </div>
                </div> 
                <div class="form-group {{ $messageBag->has('phone') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_phone">{{$labels['phone']}}
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="User_phone" name="phone"  class="form-control col-md-7 col-xs-12" value="{{ $user->phone or old('phone') }}">
                  </div>
                </div> 
                <div class="form-group {{ $messageBag->has('address') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_address">{{$labels['address']}}
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="User_address" name="address" class="form-control col-md-7 col-xs-12" value="{{ $user->address or old('address') }}">
                  </div>
                </div> 
                <div class="form-group {{ $messageBag->has('password_current') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_password_current">{{$labels['password_current']}}
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="User_password_current" name="password_current" class="form-control col-md-7 col-xs-12" value="">
                  </div>
                </div> 
                <div class="form-group {{ $messageBag->has('password') ? 'has-error' : ''}}">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_password">{{$labels['password']}}
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="User_password" name="password" class="form-control col-md-7 col-xs-12" value="">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">{{$labels['password_confirmation']}}
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="User_password_confirmation" name="password_confirmation" class="form-control col-md-7 col-xs-12" value="">
                  </div>
                </div>  
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="reset" class="btn btn-primary">Hủy</button>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>  
  </div>
@endsection
@push('custom-script')
  <script src="{{asset('/backend/js/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript">
    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  </script>
@endpush