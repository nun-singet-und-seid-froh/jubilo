<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
  <title>Nun singet und seid froh</title>
  <meta charset="utf-8">
      
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
  <link rel="stylesheet" type="text/css" href="/css/master.css">

<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//nun-singet-und-seid-froh.info/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

  @yield('head')
</head>

<body>
{{--*/ $redactionMail = 'mail@nun-singet-und-seid-froh.info' /*--}}

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
