@extends('layouts.board')

@section('head')
    <script src="{{ asset('js/epoques-update.js') }}"></script>
@endsection

@section('page-content')

<div class="title row">
  Epochen
</div>
    
    <div class="row micro-box micro-shadow optional errors alert">
        <div class="col-md-12">Hoppla, da stimmt was nicht:</div>
        <ul class="errors"></ul>
    </div>
    
    <table class="boardtable">
        <tr class="header-row">    
            <th>id</th>
            <th>Name</th>
            <th>Rank</th>
            <th>Oberepoche</th>
        </tr>  
         
        @foreach ( $epoques as $epoque )
        <tr class="epoqueinstance" id={{ $epoque['id'] }}>
            <td>{{ $epoque['id'] }}</td>
            <td><input name='name' value="{{ $epoque['name'] }}"></input></td> 
            <td><input name='rank' value="{{ $epoque['rank'] }}"></input></td>
            <td>
                <select name='superEpoque' id="superEpoque">
                    <option value="">---</option>        
                    @foreach ($epoques as $superEpoque)
                        <option value="{{ $superEpoque['id'] }}"
                        @if ( $epoque->isSubEpoqueOf()->count() > 0 )
                        @if ( $epoque->isSubEpoqueOf['id'] == $superEpoque['id'] )
                                    selected
                            @endif                
                         @endif
                        >   
                            {{ $superEpoque['name'] }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        @endforeach        
    </table>

    <button class="btn btn-primary pull-right" id="submit">Speichern</button>
    
@endsection
