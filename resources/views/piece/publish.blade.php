@extends('layouts.page')

@section('head')
    <script src="{{ asset('js/piece-publish.js') }}"></script>
    <script src="{{ asset('js/image-prepare.js') }}"></script>
    
    <link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.css" rel="stylesheet">
<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>

    
@endsection

@section('page-content')


<div class="title row">
  Stück veröffentlichen
</div>


<div class="container-fluid">

    <div class="row micro-box micro-shadow optional errors alert">
        <div class="col-md-12">Hoppla, da stimmt was nicht:</div>
        <ul class="errors"></ul>
    </div>


    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Titel</div>
        <div class="col-md-8"><input id="title"></input></div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Komponist*in</div>
            <div class="col-md-8">
                <select id="composer">
                    <option value="">...</option>
                    <option value="new">[NEUE*R KOMPONIST*IN]</option>
                    @foreach ($data['composers'] as $composer)
                        <option value={{ $composer['id'] }}>
                            {{ $composer->fullNameString('lastNameFirst') }} ({{ $composer->dateString() }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="optional composer container-fluid">
            <div class="row">
                <div class="col-md-4">Vorname</div>
                <div class="col-md-8"><input id="composer-firstName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Nachname</div>
                <div class="col-md-8"><input id="composer-lastName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Zwischennamenspartikel</div>
                <div class="col-md-8"><input id="composer-interName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Geburtsjahr</div>
                <div class="col-md-2"><input id="composer-birthYear"></input></div>
                <div class="col-md-offset-2 col-md-2">gesichert?</div>
                <div class="col-md-2"><input type="checkbox" id="composer-birthYearCertainty" checked></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Sterbejahr</div>
                <div class="col-md-2"><input id="composer-deathYear"></input></div>
                <div class="col-md-offset-2 col-md-2">gesichert?</div>
                <div class="col-md-2"><input type="checkbox" id="composer-deathYearCertainty" checked></input></div>
            </div>
            
            <div class="row">
                <div class="col-md-4">Bild</div>
                <div class="col-md-8"><input id="composer-image-raw" type="file"></input></div>
           </div>
           <div class="row">     
                <div class="col-md-8 col-md-offset-4" id="composer-image-container">
                        <img class="center-block" id="composer-image" width="100%"</img>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildbeschreibung</div>
                <div class="col-md-8"><input id="composer-image-description"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildquelle</div>
                <div class="col-md-8"><input id="composer-image-source"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildlizenz</div>
                <div class="col-md-8"><input id="composer-image-license"></input></div>
            </div>

        </div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Opus</div>
        <div class="col-md-8">
            <select id="opus">
                <option>...</option>
                <option value="new">[NEUES OPUS]</option>
                @foreach ($data['opusses'] as $opus)
                    <option value="{{ $opus['id']}}">{{ $opus['title'] }}</option>
                @endforeach
            </select>    
        </div>
        <div class="optional opus conatiner-fluid">
            <div class="col-md-4">Titel</div>
            <div class="col-md-8"><input id="opus-title"></input></div>
        </div>
        
    </div>
    
    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Jahr</div>
        <div class="col-md-8"><input type="text"></input></div>
    </div>
  
    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Schwierigkeit</div>
        <div class="col-md-8">
            <select id="difficulty">
                <option value="">...</option>
                @foreach ( $data['difficulties'] as $difficulty)
                <option value="{{ $difficulty['id'] }}">{{ $difficulty['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Epoche</div>
        <div class="col-md-8">
            <select id="epoque">
                <option value="">...</option>
                <option value="new">[NEUE EPOCHE]</option>
                @foreach ($data['epoques'] as $epoque)
                    <option value={{ $epoque['id'] }}>
                        {{ $epoque['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="optional epoque container-fluid">
            <div class="row">
                <div class="col-md-4">Name</div>
                <div class="col-md-8"><input id="epoque-name"></input></div>
            </div>
        </div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Besetzung</div>
        <div class="col-md-8">
            <select id="instrumentation">
                <option value="">...</option>
                <option value="new">[NEUE BESETZUNG]</option>
                @foreach ($data['instrumentations'] as $instrumentation)
                    <option value={{ $instrumentation['id'] }}>
                        {{ $instrumentation['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="optional instrumentation container-fluid">
            <div class="row">
                <div class="col-md-4">Stimmenzahl</div>
                <div class="col-md-8"><input id="instrumentation-numberOfVoices"></input></div>
            </div>


            <div class="row">
                <div class="col-md-4">Name</div>
                <div class="col-md-8"><input id="instrumentation-name"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Ensemble</div>
                <div class="col-md-8">
                    <select id="ensemble">
                        <option value="">...</option>
                        <option value="new">[NEUES ENSEMBLE]</option>
                        @foreach ($data['ensembles'] as $ensemble)
                            <option value={{ $ensemble['id'] }}>
                                {{ $ensemble['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>                    
            </div>

            <div class="optional ensemble">
                <div class="row">
                    <div class="col-md-4">Name</div>
                    <div class="col-md-8"><input id="ensemble-name"></input></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Text</div>
        <div class="col-md-8">
            <select id="text">
                <option value="">...</option>
                <option value="new">[NEUER TEXT]</option>
                @foreach ($data['texts'] as $text)
                    <option value={{ $text['id'] }}>
                        {{ $text['title'] }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="optional text container-fluid">
            <div class="row">
                <div class="col-md-4">Titel</div>
                <div class="col-md-8">
                    <input type="text" id="text-title"></input>
                </div>
            </div>
            
            <div class="row">       
                <div class="col-md-4">Sprache</div>
                <div class="col-md-8">
                    <select id="text-language">
                        <option value="">...</option>
                        <option value="new">[NEUE SPRACHE]</option>
                        @foreach ($data['languages'] as $language)
                            <option value={{ $language['id'] }}>
                                {{ $language['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="optional text-language container-fluid">
                    <div class="row">
                        <div class="col-md-4">Name</div>
                        <div class="col-md-8"><input id="text-language-name"></input></div>
                    </div>
                </div>

            </div><!-- optional text -->
            
            <div class="row">
                <div class="col-md-4">Textdichter*in</div>
                <div class="col-md-8">
                    <select id="text-lyricist">
                        <option value="">...</option>
                        <option value="new">[NEUE*R TEXTDICHTER*IN]</option>
                        @foreach ($data['lyricists'] as $lyricist)
                            <option value="{{ $lyricist['id'] }}">{{ $lyricist->fullNameString('lastNameFirst') }}</option>
                        @endforeach    
                    </select>
                </div>
                
            <div class="optional text-lyricist container-fluid">
            <div class="row">
                <div class="col-md-4">Vorname</div>
                <div class="col-md-8"><input id="text-lyricist-firstName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Nachname</div>
                <div class="col-md-8"><input id="text-lyricist-lastName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Zwischennamenspartikel</div>
                <div class="col-md-8"><input id="text-lyricist-interName"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Geburtsjahr</div>
                <div class="col-md-2"><input id="text-lyricist-birthYear"></input></div>
                <div class="col-md-offset-2 col-md-2">gesichert?</div>
                <div class="col-md-2"><input type="checkbox" id="text-lyricist-birthYearCertainty" checked></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Sterbejahr</div>
                <div class="col-md-2"><input id="text-lyricist-deathYear"></input></div>
                <div class="col-md-offset-2 col-md-2">gesichert?</div>
                <div class="col-md-2"><input type="checkbox" id="text-lyricist-deathYearCertainty" checked></input></div>
            </div>
            
            <div class="row">
                <div class="col-md-4">Bild</div>
                <div class="col-md-8"><input id="text-lyricist-image-file" type="file"></input></div>
                
                <div class="image-cropper" id="lyricist-image-cropper">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildbeschreibung</div>
                <div class="col-md-8"><input id="text-lyricist-image-description"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildquelle</div>
                <div class="col-md-8"><input id="text-lyricist-image-source"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Bildlizenz</div>
                <div class="col-md-8"><input id="text-lyricist-image-license"></input></div>
            </div>

        </div>

                                   
            </div>

            <div class="row">
                <div class="col-md-4">Textwurzel</div>
                <div class="col-md-8">
                    <select id="text-preText">
                        <option value="">...</option>
                        <option value="new">[NEUE TEXTWURZEL]</option>
                        @foreach ($data['preTexts'] as $preText)
                            <option value={{ $preText['id'] }}>
                                {{ $preText['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="optional text-preText container-fluid">
                    <div class="row">
                        <div class="col-md-4">Titel</div>
                        <div class="col-md-8"><input id="text-preText-title"></input></div>
                    </div>
                </div>
            </div>                 
         </div>
    </div>
       
    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Cantus</div>
        <div class="col-md-8">
            <select id="cantus">
                <option value="">...</option>
                <option value="new">[NEUER CANTUS]</option>
                @foreach ($data['cantusses'] as $cantus)
                    <option value={{ $cantus['id'] }}>
                        {{ $cantus['title'] }}
                    </option>
                @endforeach
            </select>
        </div>
 
        <div class="optional cantus container-fluid">
            <div class="row">
                <div class="col-md-4">Titel</div>
                <div class="col-md-8"><input id="cantus-title"></input></div>
            </div>
        </div>
    </div>

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">PDF</div>
        <div class="col-md-8"><input id="pdf" type="file"></input></div>
    </div>       

    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">MIDI-ZIP</div>
        <div class="col-md-8"><input id="midi-zip" type="file"></input></div>
    </div>
    
    
    <div class="row micro-box micro-shadow">
        <div class="col-md-4 main-label">Quelle</div>
        <div class="col-md-8">
            <select id="source">
                <option value="">...</option>
                <option value="new">[NEUE QUELLE]</option>
            </select>
        </div>

        <div class="optional source container-fluid">
            <div class="row">
                <div class="col-md-4">Titel</div>
                <div class="col-md-8"><input id="source-title"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Herausgeber*in</div>
                <div class="col-md-8"><input id="source-year"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Jahr</div>
                <div class="col-md-8"><input id="source-year"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Verlag</div>
                <div class="col-md-8"><input id="source-publisher"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Verlagsort</div>
                <div class="col-md-8"><input id="source-publisherAddress"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Scan</div>
                <div class="col-md-8"><input id="source-scan" type="file"></input></div>
            </div>

            <div class="row">
                <div class="col-md-4">Lizenz</div>
                <div class="col-md-8"><input id="source-license"></input></div>
            </div>            
            
        </div>        
            
    </div>
    
    
                
    </div>
    
    <button class="pull-right btn btn-primary" id="submit">Eintragen</button>
</div>

<div id="output">
</div>
@endsection
