@extends('layouts.page')

@section('page-content')

<div class="title row">
    Stück erfolgreich veröffentlicht!
</div>
Das Stück wurde veröffentlicht. <a href="{{ '/piece/show/' . $piece_id }}">Stück ansehen</a>

@endsection
