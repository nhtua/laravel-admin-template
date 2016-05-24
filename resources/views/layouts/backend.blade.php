<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <!-- Bootstrap core CSS -->

    <link href="{{asset('/backend/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('/backend/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/backend/css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/css/maps/jquery-jvectormap-2.0.1.css')}}" />
    <link href="{{asset('/backend/css/icheck/flat/green.css')}}" rel="stylesheet" />
    <link href="{{asset('/backend/css/floatexamples.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/backend/css/backend.custom.css')}}" rel="stylesheet">
    <link href="{{asset('/backend/css/backend.css')}}" rel="stylesheet">
    @stack('custom-style')
    <script src="{{asset('/backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('/backend/js/nprogress.js')}}"></script>
    <script>
        NProgress.configure({ minimum: 0.2,parent: 'div.container.body' });
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                @include("backend.nav-left")
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                @include("backend.nav-top")
            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <div class="row full-pad">
                    @yield('content')
                </div>
                @include("backend.footer")
            </div>
            <!-- /page content -->
            

        </div>

    </div>
    @yield("notification")
    
    <script src="{{asset('/backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/backend/js/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('/backend/js/custom.js')}}"></script>  
    @stack('custom-script')
    <script type="text/javascript">
        NProgress.done();
    </script>
</body>
</html>
