<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
  <title>Nun singet und seid froh</title>
  <meta charset="utf-8">
      xmlns:fb="http://ogp.me/ns/fb#">
<!-- the csrf-token for ajax requests -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta property="og:image" content="{{ asset(" />
<!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
  
<!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- bootstrap jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<!-- bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!-- custom styles -->
  <link rel="stylesheet" type="text/css" href="/public/images/logo_rot.png">
  
  @yield('head')
</head>

<body>

    <div class="row header">
        @include('layouts.header')
    </div>

    <div class="row">
        @yield('login-header')
    </div> 

    <div class="row content">  
        @yield('content')
    </div>    
    
    <div class="row footer">
      @include('layouts.footer')
    </div>

<body>

</html>
