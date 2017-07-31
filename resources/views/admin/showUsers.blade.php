@extends('layouts.page')


@section('head')
    <script src="{{ asset('js/user-update.js') }}"></script>
@endsection

@section('page-content')

<div class="title row">
  Userverwaltung
</div>
    
    <div class="row micro-box micro-shadow optional errors alert">
        <div class="col-md-12">Hoppla, da stimmt was nicht:</div>
        <ul class="errors"></ul>
    </div>
    
    <table class="boardtable">
        <tr class="header-row">    
            <th>User</th>
            <th>Angelegt</th>
            <th>E-Mail</th>
            @foreach ( $data['roles'] as $role )
            <th>{{ $role['slug'] }}</th>
            @endforeach
        </tr>   
    @foreach ( $data['users'] as $user )
    
    <tr class="userinstance" id={{ $user['id'] }}>
        <td>{{ $user['name'] }}</td> 
        <td>{{ $user['created_at'] }}</td>
        <td>{{ $user['email'] }}</td>

        <!-- the roles checkboxes -->
        @foreach ( $data['roles'] as $role )
        <td class="role"><input type="checkbox" name={{ $role['id'] }}
            @if ( $user->hasRole($role['name'] ) )
                checked
            @endif
            ></input>
        </td> 
        @endforeach                       
    </tr>
    
    @endforeach        
    </table>

    <button class="btn btn-primary pull-right" id="submit">Speichern</button>
    
    
@endsection
