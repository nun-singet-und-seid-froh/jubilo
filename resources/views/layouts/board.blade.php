@extends('layouts.master')

@section('content')

<div class="container-fluid">
     
    <div class="row">
    
        <div class="col-lg-3 col-md-3">
            <div class="board-navigation-col macro-box macro-shadow">
            @if (  Auth::user()->hasRole('editor') )
                @include('board.editor-nav')
            @endif        

            @if (  Auth::user()->hasRole('admin') )
                @include('board.admin-nav')
            @endif
            </div>
        </div>

        <div class="col-lg-9 col-md-9">
            <div class="board-content-col macro-box macro-shadow">
                @yield('page-content')
            </div>
        </div>

        
    </div>
</div>
@endsection