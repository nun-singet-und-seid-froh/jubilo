@extends('layouts.board')

@section('head')
    <script src="{{ asset('js/source-create.js') }}"></script>
@endsection

@section('page-content')
<div class='title row'>
    Quelle erstellen
</div>

@include('source.create-body')


<button class="pull-right btn btn-primary" id="submit">Eintragen</button>

@endsection