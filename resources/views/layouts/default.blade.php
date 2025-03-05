<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📋 @yield("title","To Do App")</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
      .animated-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(-45deg, #ff9a9e, #ffc8b9, #ffdde1, #fc6076);
        background-size: 400% 400%;
        animation: gradientShift 10s ease infinite;
        z-index: -1;
        opacity: 0.8;
      }

      @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }
    </style>
  </head>
  <body class="d-flex flex-column h-100">
    <!-- Animated Background -->
    <div class="animated-background"></div>
    @include("include.header")
    
      @yield("content")
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
  </body>
</html>