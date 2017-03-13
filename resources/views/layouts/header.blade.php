
<nav class="header navbar navbar-fixed-top">
  <div class="container-fluid micro-shadow">
    @if (Auth::check()) 
    <div class="row">
        <div class="login-information">
            Angemeldet als <b>{{ Auth::user()->name }}</b>
            <span class="pull-right"><a href="/logout" class="hint-link">Ausloggen</a></span>
        </div>    
    </div>        
    @endif    

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>      
      </button>
      <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/catalogue">Katalog</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/about">Über das Projekt</a></li>

        <li><a href="/board">Redaktion</a></li>
      </ul>
    </div>
  </div>
</nav>
