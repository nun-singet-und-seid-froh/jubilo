@extends('layouts.master')

@section('head')
 
<!-- font awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<!-- start page specific css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/start.css') }}">

<!-- css and js for the scrolling effect -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/scroll.css') }}">
  <script src="{{ asset('js/scroll.js') }}"></script>

@endsection


@section('content')
    
    @include('start.title')
    
@endsection
