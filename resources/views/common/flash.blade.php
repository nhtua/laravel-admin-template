@if ($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <ul>
  @foreach ($messageBag->getMessages() as $key => $error)
    <li><strong>{{$labels[$key] or $key}}:</strong> {{ $error[0] }}</li>
  @endforeach
  </ul>
</div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check"></i>{{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-exclamation-triangle"></i>{{ session('error') }}
    </div>
@endif