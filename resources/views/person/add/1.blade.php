@extends('layouts.page')

@section('page-content')

@if $type=='composer'
    $typeString = 'Komponist*in'
@endif
    
    <div class="title row">{{ $typeString }}
     hinzufügen</div>

<div class="container-fluid">
  <div class="row">


@if ( count($errors) > 0 )
  <div class="alert">
    Leider entsprechen einige Angaben nicht den Erfordernissen. Bitte korrigiere bzw. ergänze deine Angaben entsprechend:
      
    <ul>
    @foreach ( $errors->all() as $error )
      <li>{{ $error }}</li>
    @endforeach 
    </ul>
  </div>
@endif


    <div class="form">
      {!! Form::open(['action'=>'ComposerController@store', 'method'=>'POST']) !!}
      
        <div class="form-group col-lg-12 col-md-12">
        {!! Form::label('firstName', 'Vorname(n):', ['class'=>'col-lg-5 col-md-5 col-sm-12 col-xs-12']) !!}
        {!! Form::text('firstName',  '', ['class'=>'col-lg-7 col-md-7 col-sm-12 col-xs-12'] ) !!}
        </div>
          
    <div class="form-group col-lg-12 col-md-12">
        {!! Form::label('lastName', 'Nachname:', ['class'=>'col-lg-5 col-md-5 col-sm-12 col-xs-12']) !!}
        {!! Form::text('lastName',  '', ['class'=>'col-lg-7 col-md-7 col-sm-12 col-xs-12']) !!} 
    </div>

    <div class="form-group col-lg-12 col-md-12">
        {!! Form::label('interName', 'Zwischennamenspartikel:', ['class'=>'col-lg-5 col-md-5 col-sm-12 col-xs-12']) !!}
        {!! Form::text('interName', '', ['class'=>'col-lg-7 col-md-7 col-sm-12 col-xs-12']) !!}
    </div>
    
    
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      {!! Form::label('birthYear', 'Geburtsjahr:', ['class'=>'col-lg-5 col-md-5 col-sm-9 col-xs-9'] ) !!}
      {!! Form::text('birthYear', '', ['class'=>'col-lg-3 col-md-3 col-sm- col-xs-4']) !!}

      <label class="col-lg-2 col-md-2 col-sm-3 col-xs-3">gesichert</label>
      <input type="checkbox" name="deathYearCertainty" checked="true" class="col-lg-2 col-md-2"/>
    </div>    


    <div class="form-group col-lg-12 col-md-12">
      {!! Form::label('deathYear', 'Sterbejahr:', ['class'=>'col-lg-5 col-md-5 col-sm-12 col-xs-12'] ) !!}
      {!! Form::text('deathYear', '', ['class'=>'col-lg-3 col-md-3 col-sm-12 col-xs-12']) !!}

      <label class="col-lg-2 col-md-2 col-sm-12 col-xs-12">gesichert</label>
      <input type="checkbox" name="deathYearCertainty" checked="true" class="col-lg-2 col-md-2"/>
    </div> 

    <div class="form-group col-lg-12 col-md-12">         
        {!! Form::submit('Eintragen', ['class'=>'pull-right btn btn-primary']) !!}
    </div>        
    
      {!! Form::close() !!}
    </div>
  </div>
</div>  
@endsection
