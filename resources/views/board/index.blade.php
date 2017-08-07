@extends('layouts.board')

@section('page-content')

<div class="title row">
    Redaktionsbereich
</div>


Du bist angemeldet als <b>{{ Auth::user()->name }}</b> ({{ Auth::user()->email }}). 
Du hast die folgenden  Rechte:
</ul>
    @foreach (Auth::user()->roles()->get() as $role)
        <li>{{ $role['slug'] }} ({{ $role['description'] }})</li>
    @endforeach
</ul>
@endsection
