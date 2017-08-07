@extends('layouts.board')

@section('page-content')

<div class="title row">
    Stück erfolgreich veröffentlicht!
</div>
Das Stück wurde veröffentlicht. <a href="{{ '/piece/show/' . $piece_editionNumber }}">Stück ansehen</a>

@endsection
