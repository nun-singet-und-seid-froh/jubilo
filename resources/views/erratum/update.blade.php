@extends('layouts.board')

@section('head')
    <script src="{{ asset('js/erratum-update.js') }}"></script>
@endsection

@section('page-content')

<div class="title row">
  Errata
</div>
    
    <div class="row micro-box micro-shadow optional errors alert">
        <div class="col-md-12">Hoppla, da stimmt was nicht:</div>
        <ul class="errors"></ul>
    </div>
    
    <table class="boardtable">
        <tr class="header-row">    
            <th>id</th>
			<th>Status</th>
            <th>Stück</th>
			<th>Stimme</th>
            <th>Taktnummer</th>
            <th>Beschreibung</th>
        </tr>  
         
        @foreach ( $data['erratums'] as $erratum )
        <tr class="erratuminstance" id={{ $erratum['id'] }}>
            <td>{{ $erratum['id'] }}</td>
			<td class="{{ 'erratum-status-' . $erratum['status'] }}">
				<select class='erratum-status'>
				@foreach ( $data['erratumStatusses'] as $status )
					<option 
						value = {{ $status }}
						@if ($erratum['status'] == $status)
							selected
						@endif
					> {{ $status }}
					</option>
				@endforeach				
				</select>
			</td>
			<td>{{ $erratum->piece->getString() }}</td>
			<td>{{ $erratum['voice'] }}</td>
			<td>{{ $erratum['bar_number'] }}</td>
			<td>{{ $erratum['description'] }}</td>
        </tr>
        @endforeach        
    </table>
    
@endsection
