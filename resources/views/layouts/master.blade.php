<html>
<head>
  <title>Nun singet und seid froh</title>
  <meta charset="utf-8">
<!-- the csrf-token for ajax requests -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
<!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
  
<!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- bootstrap jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<!-- bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!-- custom styles -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
  
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
      <div class="col-lg-offset-1 col-lg-10 col-md-12 col-sm-12 col-xs-12"> 
        @yield('content')
      </div>
    </div>    
    
    <div class="row footer">
      @include('layouts.footer')
    </div>

<body>

</html>
