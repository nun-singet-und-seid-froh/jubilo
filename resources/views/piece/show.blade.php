@extends('layouts.page')

@section('page-content')

<div class="title row">
    {{ $data['title'] }}
</div>

<?php
    $information_items = [
        'year'  => ['caption' => 'Jahr', 'var' => $data['year']],
        'opus' => ['caption' => 'Opus', 'var' => $data['opus']],
        'instrumentation' => ['caption' => 'Besetzung', 'var' => $data['instrumentation']],
        'epoque' => ['caption' => 'Epoche', 'var' => $data['epoque']],
        'difficulty' => ['caption' => 'Schwierigkeit', 'var' => $data['difficulty']],
        'cantus' => ['caption' => 'Cantus', 'var' => $data['cantus']],
        'language' => ['caption' => 'Sprache', 'var' => $data['language']],
        'preText' => ['caption' => 'Prätext', 'var' => $data['preText']],
    ];
    
    $download_items = [
        'pdf' => ['caption' => 'PDF', 'var' => $data['pdf']['string'], 'link' => $data['pdf']['link']],
        'midi' => ['caption' => 'MIDI', 'var' => $data['midi']['string'], 'link' => $data['midi']['link']],
        'recording' => ['caption' => 'Aufnahme', 'var' => $data['recording']['string'], 'link' => $data['recording']['link']],
        'sourcecode' => ['caption' => 'Quellcode', 'var' => $data['sourcecode']['string'], 'link' => $data['sourcecode']['link']],
    ]
?>
    
<div class="row">
    <div class="col-lg-6 col-md-6 macro-column"><!-- left column -->
        <div class="row column-cotainer">
            <div class="col-lg-6 col-md-6 col-sm-6 micro-column"><!-- composer -->
                <div class="micro-box micro-shadow">
                    <div class="box-title">Komponist*in</div>
                    <div>
                        {{ $data['composer']['name'] }}<br>{{ $data['composer']['dates'] }}
                     </div>
                     @if ($data['composer']['image'] <> "0")
                     <img 
                        class="hidden-sm hidden-xs"
                        src="{{ $data['composer']['image']['href'] }}" 
                        title="{{ $data['composer']['image']['hint'] }}"
                        width="100%"
                     >
                     @endif
                </div>
            </div>    
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 micro-column"><!-- lyricist -->
                <div class="micro-box micro-shadow">
                    <div class="box-title">Dichter*in</div>
                    <div>
                        {{ $data['lyricist']['name'] }} <br>{{ $data['lyricist']['dates'] }}
                     </div>
                     @if ($data['lyricist']['image'] <> NULL)
                     <img 
                        class="hidden-sm hidden-xs"
                        src="{{ $data['lyricist']['image']['href'] }}" 
                        title="{{ $data['lyricist']['image']['hint'] }}"
                        width="100%"
                     >
                     @endif
                     
                </div>
            </div>
        </div>

    <div class="row">    
        <div class="col-lg-12 col-md-12 micro-column"><!-- informations -->
            <div class="micro-box micro-shadow">
                <div class="box-title">Meta-Daten</div>
                <div class="row">
                @foreach ($information_items as $item)
                    <div class="col-md-4 caption">{{ $item['caption'] }}</div>
                    <div class="col-md-8">{{ $item['var'] }} </div>
                @endforeach

                    <div class="col-md-4 caption">Quelle(n)</div>
                    <div class="col-md-8">
                        @foreach ( $data['sources'] as $source )
                           {!! $source->getHTMLString() !!}.
                        @endforeach
                        </div>
                
                </div>                     
            </div>
        </div>
    </div>
            
    <div class="row">                
        <div class="col-lg-12 col-md-12 micro-column"><!-- downloads -->            
            <div class="micro-box micro-shadow">
                <div class="box-title">Downloads</div>
                <div class="row">
                @foreach ($download_items as $item)
                    <div class="col-md-4 caption">{{ $item['caption'] }}</div>
                    @if ($item['caption'] == "Quellcode")
                        <div class="col-md-8"><a href="{{ $item['link'] }}" target="_blank" class="external">
                    @else  
                        <div class="col-md-8"><a href="{{ $item['link'] }}" target="_blank">
                    @endif
                    {{ $item['var'] }}</a></div>
                @endforeach
                </div>    
            </div>
       </div>
   </div>         
</div> 
   
    <div class="pdf-preview col-lg-6 col-md-6 hidden-sm hidden-xs macro-column"><!-- right column -->
        <div class="micro-column row">
            <div class="micro-box micro-shadow"> <!-- pdf -->
                <object data="{{ $data['pdf']['link'] }}#page=2" type="application/pdf" height="100%" width="100%">
                    <embed src="{{ $data['pdf']['link'] }}#page=2"></embed>
                </object>
            </div>
        </div>
    </div>
    
</div>	

@endsection
