<?php
  $cacheKey = "HTML_CACHE:".Request::path();
?>
@cache($cacheKey)
<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name=viewport content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="{{asset('frontend/fonts/roboto.cs')}}s">
  <link rel="stylesheet" href="{{asset('frontend/css/elegantfont.css')}}"/>
  <link rel="stylesheet" href="{{asset('frontend/css/reset.cs')}}s">
  <link rel="stylesheet" href="{{asset('frontend/css/flexslider.cs')}}s">
  <link rel="stylesheet" href="{{asset('frontend/css/animate.cs')}}s">
  <link rel="stylesheet" href="{{asset('packages/fancybox/source/jquery.fancybox.css')}}"> 
  <link rel="stylesheet" href="{{asset('frontend/css/style.cs')}}s">
  <link rel="stylesheet" href="{{asset('frontend/css/queries.cs')}}s">
  @stack('styles')
  <script src="{{asset('frontend/js/modernizr.js')}}"></script>
    
  <title>Coca-Cola - @yield('title')</title>
</head>
<body>

<main>
  @yield('content')
</main>

<div class="ch-cover-layer"></div>
<div class="ch-loading-bar"></div>
<script src="{{asset('frontend/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('packages/fancybox/source/jquery.fancybox.js')}}"></script>
<script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-imagefill.js')}}"></script>
<script src="{{asset('frontend/js/wow.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
@stack('scripts')
</body>
</html>
@endcache