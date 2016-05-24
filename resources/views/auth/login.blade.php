@extends('layouts.auth')

@section('content')
<div id="login" class="animate form">
    <section class="login_content">
        <form role="form" method="POST" action="{{ url('/login') }}">
            <h1>Let me in!</h1>
            @include('common.flash')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <input type="email" name="email" class="form-control" placeholder="E-Mail Address" required="" value="{{ old('email') }}" />
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>

            <div class="pull-left">
                <input type="checkbox" name="remember" id="rememberMe">
                <label for="rememberMe">Remember Me</label>
            </div>
            <div class="clearfix"></div>
            <div>
                <button type="submit" class="btn btn-default submit"><i class="fa fa-unlock"></i> Log in</button>
                <a class="reset_pass" href="{{ url('/password/email') }}">Lost your password?</a>
            </div>            
            <div class="clearfix"></div>
            <div class="separator">                
                <div class="clearfix"></div>
                <br />
                <div>
                    <h1><i class="fa fa-paw"></i> {{env('APP_NAME','coca.vn')}}</h1>

                    <p>©{{date('Y')}} All Rights Reserved</p>
                </div>
            </div>
        </form>
        <!-- form -->
    </section>
    <!-- content -->
</div>
@endsection
