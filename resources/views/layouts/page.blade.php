@extends('layouts.master')

@section('content')
<div class="col-lg-offset-1 col-lg-10 col-md-12 col-sm-12 col-xs-12">
    <div class="bg">
      <div class="page macro-box macro-shadow container-fluid">
        @yield('page-content')
      </div>  
    </div>
</div>
@endsection
