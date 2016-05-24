@extends('layouts.auth')

<!-- Main Content -->
@section('content')
<div id="reset" class="animate form">
    <section class="login_content">
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            <h1>I forgot my password</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            {!! csrf_field() !!}
            <div>
                <input type="email" name="email" class="form-control" placeholder="E-Mail Address" required="" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="clearfix"></div>
            <div>
                <button type="submit" class="btn btn-default submit">
                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                </button>                
            </div>            
            <div class="clearfix"></div>
            <div class="separator">                
                <div class="clearfix"></div>
                <br />
                <div>
                    <h1><img src="/frontend/images/MENU_LOGO.png" height="22"> {{env('domain','coca.vn')}}</h1>

                    <p>©{{date('Y')}} All Rights Reserved</p>
                </div>
            </div>
        </form>
        <!-- form -->
    </section>
    <!-- content -->
</div>
@endsection
