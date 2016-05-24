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
    <form method="POST" action="{{route($user->isNew() ? 'backend::user.save' : 'backend::user.update')}}"  enctype="multipart/form-data" id="UserForm" class="form-horizontal form-label-left">
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

        <div class="form-group {{ $messageBag->has('password') ? 'has-error' : ''}}">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_password">{{$labels['password']}} {!! $user->id == '' ? '<span class="required">*</span>' : '' !!}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" id="User_password" name="password"  {{$user->id == '' ? 'required="required"' : ''}} class="form-control col-md-7 col-xs-12" value="">
            @if(!$user->isNew())
            <em class="hint">type password when you want to change, or vice versa, let it empty</em>
            @endif
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">{{$labels['password_confirmation']}}{!! $user->id == '' ? '<span class="required">*</span>' : '' !!}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" id="User_password_confirmation" name="password_confirmation" {{$user->id == '' ? 'required="required"' : ''}} class="form-control col-md-7 col-xs-12" value="">
          </div>
          <a href="#" onclick="(function(p){$('#User_password').val(p);$('#User_password_confirmation').val(p)})('{{env('DEFAULT_PASSWORD','123456a@')}}')" class="btn btn-primary">Use default password {{env('DEFAULT_PASSWORD','123456a@')}}</a>
        </div>  
        
        @if(!$user->isNew())
        <div class="form-group {{ $messageBag->has('status') ? 'has-error' : ''}}">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_status">{{$labels['status']}}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" id="User_status" name="status">
            {!!$user->getStatusOptions($user->status | old('status'))!!}
            </select>
          </div>
        </div>
        @endif

        <div class="form-group {{ $messageBag->has('roles') ? 'has-error' : ''}}">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User_roles">{{$labels['roles']}}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!!$user->getRoleOptions()!!}
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
@push('custom-script')
  <script src="{{asset('/backend/js/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript">
    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  </script>
@endpush