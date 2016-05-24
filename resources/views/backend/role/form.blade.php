<?php 
  $labels = $role->getLabels();
  $messageBag = $errors->getBag('default');
?>

<div class="x_title">
    <h2>Grant permission for {{$role->display_name}}</h2>
    <div class="clearfix"></div>
</div>
<div class="x_content">
    <br>
    <form method="POST" action="{{route('backend::role.update')}}"  enctype="multipart/form-data" id="UserForm" class="form-horizontal form-label-left">
        @include('common.flash')
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{{ $role->id }}}" />
                
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role_name">{{$labels['name']}} <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="Role_name" name="name"  readonly="readonly" class="form-control col-md-7 col-xs-12" value="{{$role->name}}">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role_display_name">{{$labels['display_name']}} <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="Role_display_name" name="display_name"  readonly="readonly" class="form-control col-md-7 col-xs-12" value="{{$role->display_name}}">
          </div>
        </div>

        <div class="form-group {{ $messageBag->has('description') ? 'has-error' : ''}}">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role_description">{{$labels['description']}}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="Role_description" name="description"   class="form-control col-md-7 col-xs-12" value="{{ $role->description or old('description') }}">
          </div>
        </div> 

        <div class="form-group {{ $messageBag->has('permission') ? 'has-error' : ''}}">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role_permission">{{$labels['permission']}}
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!!$role->getPermsOptions()!!}
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