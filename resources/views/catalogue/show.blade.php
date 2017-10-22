@extends('layouts.page')

@section('head')
     <script src="{{ asset('js/catalogue-filter.js') }}"></script>
@endsection

@section('page-content')

<div class="title row">
    Katalog
    <div class="title-sub">
        <a class="hint-link" href="/catalogue/help" target="_blank">Hilfe zur Benutzung des Katalogs</a>
    </div>
</div>


<div class="filter-area micro-box row">
    
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Titel</div>

        <select id="titles">
            <option value=""></option>
            @foreach ( $data['pieces'] as $piece) 
            <option value="{{ $piece['title'] }}">{{ $piece['title'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Komponist*in</div>
        <select id="composers">
            <option value=""></option>
            @foreach ( $data['composers'] as $composer) 
            <option value="{{ $composer['id'] }}">{{ $composer->fullNameString('lastNameFirst')}} ({{$composer->dateString() }})</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Opus</div>
        <select id="opusses">
            <option value=""></option>
            @foreach ( $data['opusses'] as $opus) 
                <option value="{{ $opus['id'] }}">{{ $opus['title'] }}</option>
            @endforeach

        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Epoche</div>
        <select id="epoques">
            <option value=""></option>
            @foreach ( $data['epoques'] as $epoque) 
            <option value="{{ $epoque['id'] }}">{{ $epoque['name'] }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Cantus</div>
        <select id="cantusses">
            <option value=""></option>
            @foreach ( $data['cantusses'] as $cantus) 
            <option value="{{ $cantus['id'] }}">{{ $cantus['title'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Librettist*in</div>
        <select id="lyricists">
            <option value=""></option>
            @foreach ( $data['lyricists'] as $lyricist) 
            <option value="{{ $lyricist['id'] }}">{{ $lyricist->fullNameString('lastNameFirst') }}, ({{ $lyricist->dateString() }})</option>
            @endforeach
        </select>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Sprache</div>
        <select id="languages">
            <option value=""></option>
            @foreach ( $data['languages'] as $language) 
            <option value="{{ $language['id'] }}">{{ $language['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Prätext</div>
        <select id="pretexts">
            <option value=""></option>
            @foreach ( $data['pretexts'] as $pretext) 
            <option value="{{ $pretext['id'] }}">{{ $pretext['title'] }}</option>
            @endforeach
        </select>
    </div>



    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Schwierigkeit</div>
        <select id="difficulties">
            <option value=""></option>
            @foreach ( $data['difficulties'] as $difficulty) 
            <option value="{{ $difficulty['id'] }}">{{ $difficulty['name'] }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Stimmenzahl</div>
        <select id="numberOfVoices">
            <option value=""></option>
            @foreach ( $data['numberOfVoices'] as $number) 
            <option value="{{ $number }}">{{ $number }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Ensemble</div>
        <select id="ensembles">
            <option value=""></option>
            @foreach ( $data['ensembles'] as $ensemble) 
            <option value="{{ $ensemble['id'] }}">{{ $ensemble['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6">
        <div>Besetzung</div>
        <select id="instrumentations">
            <option value=""></option>
            @foreach ( $data['instrumentations'] as $instrumentation) 
            <option value="{{ $instrumentation['id'] }}">{{ $instrumentation['name'] }}</option>
            @endforeach
        </select>
    </div>
 
</div>
<div class="row counter"><span id="counter-number">{{ $data['piece-count'] }}</span> Titel</div>

<div class="row pieces">
    @foreach ( $data['pieces'] as $piece )

    <div class="catalogue-item micro-box micro-shadow">
        <div class="composer-name">
            @if ( $piece->composers()->first() )
                {{ $piece->composers()->first()->fullNameString("firstNameFirst") }}
            @else
                !!! Falsch hochgeladenes Stück !!!
            @endif
         </div>   
        <div class="piece-title">
            <a href="{{ route('showPiece', $piece['editionNumber']) }}">{{ $piece['title'] }}</a>
        </div>
        <div class="informations">
            <ul class="informations">
                <li>{{ $piece->instrumentation->ensemble['name'] }}</li>
                <li>{{ $piece->instrumentation['numberOfVoices'] }}-stimmig</li>
                <li>{{ $piece->instrumentation['name'] }}</li>

                
                <li>{{ $piece->difficulty['name'] }}</li>                
                <li>{{ $piece->epoque['name'] }}</li>
                @if ( $piece->text )
                    @foreach ( $piece->text->languages as $language )
                        <li class="language">{{ $language['name'] }}</li>
                    @endforeach
                @endif
            </ul>    
        </div>
    </div>
    @endforeach
</div>

<div class="testwrite"></div>
@endsection
