@extends('layouts.page')

@section('head')
	<script src="{{ asset('js/erratum-create.js') }}"></script>
@endsection

@section('page-content')
<div class="title row">
	Erratum melden
</div>

<div class="container-fluid">
    <div class="row micro-box micro-shadow">
 


	<div class="micro-box"><p>Vielen Dank, dass du das Erratum meldest, das du gefunden hast! So können wir das korrigieren und andere Nutzer*innen müssen bald nicht mehr aus fehlerhaften Noten singen!</p> 
<p>Wenn du über die Bearbeitung deiner Erratums-Meldung auf dem Laufenden gehalten werden möchtest, gib deine E-Mail-Adresse an. Deine E-Mail-Adresse wird ausschließlich für den Bericht verwendet und nach abschließender Bearbeitung des Erratums wieder aus unserer Datenbank gelöscht. Wenn du keine Benachrichtigungen erhalten möchtest, lass das entsprechende Feld einfach leer.
</p>
	</div>

 <div class="micro-box micro-shadow optional errors alert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Hoppla, da stimmt was nicht:</div>
        <ul class="errors"></ul>
    </div>
        <div class="col-md-4 main-label">Stück</div>
        <div class="col-md-8">
            <select id="piece_id">
                @foreach ($data['pieces'] as $piece)
                <option value="{{ $piece['id'] }}"
					@if ($piece['id'] == $data['selected_id'])
						select
					@endif
				> {{ $piece->getString() }}
                </option>
                @endforeach
            </select>
        </div>

		<div class="col-md-4 main-label">Takt Nr.</div>
        <div class="col-md-8"><input id="bar_number"/></div>

		<div class="col-md-4 main-label">Stimme</div>
        <div class="col-md-8"><input id="voice"/></div>

		<div class="col-md-4 main-label">Beschreibung</div>
        <div class="col-md-8"><input id="description"/></div>

		<div class="col-md-4 main-label">E-Mail</div>
        <div class="col-md-8"><input id="email"/></div>

		<button class="pull-right btn btn-primary" id="submit">Abschicken</button>
	</form>
  </div>   
@endsection


