@extends('layouts.board')

@section('page-content')

<div class="title row">
    Redaktionsbereich
</div>


<h1>Redaktionsfunktionen</h1>
<h2>Neu eintragen</h2>
    <li><a href="/piece/publish">Neues Stück eintragen</a></li>

<h2>Übersichten</h2>
    <li><a href="/board/epoques">Epochen</a></li>
    
<h1>Admin-Funktionen</h1>    
    <li><a href="/admin/users">Userverwaltung</a></li>

<a class="pullright" href="/logout">Ausloggen</a>
@endsection
