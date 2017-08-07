@extends('layouts.board')

@section('page-content')

<div class="title row">
    Quellen
</div>

<div class="row">
    <table class="boardtable">
        <tr class="header-row">    
            <th>id</th>
            <th>Titel</th>
            <th>Herausgeber</th>
            <th>Verlag</th>
            <th>Jahr</th>
            <th>Scan</th>
            <th>Link</th>
            <th>Stücke</th>
            
            
        </tr>        
    @foreach ($sources as $source)
        <tr class="sourceinstance" id={{ $source['id'] }}>
            <td>{{ $source['id'] }}</td>
            <td>{{ $source['title'] }}</td>
            <td>{{ $source['editors'] }}</td>
            <td>{{ $source['publisher'] }}</td>
            <td>{{ $source['year'] }}</td>
            <td>
                @if ( $source['fileName'] ) 
                    <a target="_blank" href="/public/sources/{{ $source['fileName'] }}">.pdf</a>
                @endif
            </td>
            <td><a target="_blank" href={{ $source['url'] }} >{{ $source['url'] }}</a></td>
            
            <td>
                @foreach ( $source->pieces()->get() as $piece )
                    <a target="_blank" href="/piece/show/{{ $piece['editionNumber'] }}">{{ $piece->composers()->first()->fullNameString('firstNameFirst') }}: {{ $piece['title'] }}</a>, 
                @endforeach
            </td>
        </tr>
    @endforeach
    </table>
</div>

@endsection