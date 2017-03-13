<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storage;

use App\Models\Piece;
use App\Models\Image;
use App\Models\Person;
use App\Models\Difficulty;
use App\Models\Epoque;
use App\Models\Instrumentation;
use App\Models\Language;
use App\Models\Cantus;
use App\Models\Opus;
use App\Models\Text;
use App\Models\Sheet;
use App\Models\Position;
use App\Models\Ensemble;

use Session;


class PieceController extends Controller
{
    public function show($id) {
      $piece = Piece::find($id);

      if ( $piece ) {  

        // increment the visit-counter
        $piece['visits'] = $piece['visits'] + 1;
        $piece->save();

        $view_data = [];
        

        // pass $view_data to view
        $view_data['title'] = $piece['title'];

        $view_data['composer']['name'] = $piece->composers->first()->fullNameString('firstNameFirst');
        $view_data['composer']['dates'] = $piece->composers->first()->dateString();

        if ( $piece->composers->first()->image()  ) {
          $view_data['composer']['image']['href'] = $piece->composers->first()->image->path();
          $view_data['composer']['image']['hint'] = $piece->composers->first()->image->hint();
        }
        else{
          $view_data['composer']['image'] = NULL;
        }

        if ($piece->text->lyricist()->get()->count() > 0 ){
        $view_data['lyricist']['name'] = $piece->text->lyricist->fullNameString('firstNameFirst');
        $view_data['lyricist']['dates'] = $piece->composers->first()->dateString();

            if ( $piece->text->lyricist->image['id'] <> 0 ) {
              $view_data['lyricist']['image']['href'] = $piece->text->lyricist->image->path();
              $view_data['lyricist']['image']['hint'] = $piece->text->lyricist->image->hint();
            }            
        }
        else{
            $view_data['lyricist']['name'] = "Unbekannt";
            $view_data['lyricist']['dates'] = "";
            $view_data['lyricist']['image'] = NULL;            
        }
        
        // the meta-data
        if ( $piece->opus()->get()->count() > 0 ) {
            $view_data['opus'] = $piece->opus['title'];
        }
        else {
            $view_data['opus'] = "–";
        }
        $view_data['instrumentation'] = $piece->instrumentation['name'];
        $view_data['epoque'] = $piece->epoque['name'];
        $view_data['difficulty'] = $piece->difficulty['name'];
        $view_data['epoque'] = $piece->epoque['name'];
        
        if ( $piece->cantusses()->count() > 0 ){
            $view_data['cantus'] = $piece->cantusString();
        }
        else {
            $view_data['cantus'] = "–";
        }
        
        $view_data['language'] = $piece->text->languageString();
        
        if ( $piece->text->preText()->get()->count() > 0 ){
            $view_data['preText'] = $piece->text->preText->title();
        }
        else {
            $view_data['preText'] = "–";
        }    
        
        
        if ($piece['year']){
            $view_data['year'] = $piece['year'];
        }
        else {    
            $view_data['year'] = 'unbekannt';
        }

        if (!$piece['epoque']){
          $view_data['epoque'] = 'unbekannt';
        }
        else {
          if ( ! is_null($piece->epoque->isSubEpoqueOf() )) {
            $piece['superEpoque'] = $piece->epoque->isSubEpoqueOf['name'];
          }
          $piece['epoque'] = $piece->epoque['name'];
        }
        
        // instrumentation
        if ( is_null($piece->instrumentation()->first() ) ) {
          $piece['instrumentation'] = 'unbekannt';
        }
        else {
          $piece['instrumentation'] = $piece->instrumentation->link();
        }
        
       $view_data['pdf']['string'] = ".pdf";
       $view_data['pdf']['link'] = $piece->sheet->path();
       
       $view_data['midi']['string'] = ".zip";
       $view_data['midi']['link'] = "";

       if ( $piece->recordings()->count() > 0 ){         
           $view_data['recording']['string'] = "PDF";
           $view_data['recording']['link'] = "PDF";                      
       }
       else{
           $view_data['recording']['string'] = "-";
           $view_data['recording']['link'] = "PDF";                      
       }
          
       $view_data['sourcecode']['string'] = "auf github";
       $view_data['sourcecode']['link'] = $piece['sourcecode'];                      

        return view('piece.show', ['data'=>$view_data]);
      }
      return view('errors.404');    
    }
    
    public function publish() {
        $titles = [];        
        $view_data = [];
        
        foreach ( Piece::all() as $key => $piece ) {
            if ( !( in_array($piece['title'], $titles)) ) {
                array_push($titles, $piece['title']);
            }
        }
        
        $view_data['composers'] = Person::whereHas(
            'positions', function($position){
                $position->where('name', 'composer');
            }
        )->orderBy('lastName')->get();
        $view_data['opusses'] = Opus::has('pieces')->orderBy('title')->get();
        $view_data['titles'] = $titles;
        $view_data['difficulties'] = Difficulty::all();
        $view_data['epoques'] = Epoque::orderBy('name')->get();
        $view_data['instrumentations'] = Instrumentation::orderBy('name')->get();
        $view_data['texts'] = Text::orderBy('title')->get();
        $view_data['languages'] = Language::orderBy('name')->get();
        $view_data['ensembles'] = Ensemble::orderBy('name')->get();

        $view_data['difficulties'] = Difficulty::all();
        $view_data['cantusses'] = Cantus::all();        
        $view_data['preTexts'] = Text::where('preText_id', 0)->get();
        $view_data['lyricists'] = Person::whereHas(
            'positions', function($position){
                $position->where('name', 'lyricist');
            }
        )->orderBy('lastName')->get();

        return view('piece.publish', ['data'=> $view_data]);
    }
    
    public function store(Request $request) {
        /*
         *   VALIDATION
        */  
        
        $rules = [
            'title' => 'required',
            'composer_id' => 'required',
                'composerImage' => 'required_if:composer_id,"new"',
                'composerImageDescription' => 'required_if:composer_id,"new"',
                'composerImageLicense' => 'required_if:composer_id,"new"',
                'composerImageSource' => 'required_if:composer_id,"new"',                
                'composerLastName' 
                    =>'required_if:composer_id,"new"|unique_with:persons, composerLastName = lastName, composerInterName = interName, composerFirstName = firstName',

                'composerBirthYear' => 'required_if:composer_id,"new"|numeric|max:composerDeathYear',
                'composerDeathYear' => 'required_if:composer_id,"new"|numeric|max:1947',
                'composerImageSource' => 'required_if:composer_id,"new"',
                'composerImageLicense' => 'required_if:composer_id,"new"',                
            'difficulty_id' => 'required',
            
            'opusTitle' => 'required_if:opus_id,"new',
            'epoque_id' => 'required',
                'epoqueName' => 'unique:epoques,name|required_if:epoque_id,"new"',
                
            'instrumentation_id' => 'required',
                'instrumentationNumberOfVoices' => 'required_if:instrumentation_id,"new',

                'instrumentationName' => 'unique:instrumentations,name|required_if:instrumentation_id,"new',
                'ensemble_id' => 'required_if:instrumentation_id,"new"',
                    'ensembleName' => 'unique:ensembles,name|required_if:ensemble_id,"new"',
            
            'text_id' => 'required',
                'textTitle' => 'required_if:text_id,"new"',
                'textLanguage_id' => 'required_if:text_id,"new"',
                    'textLanguageName' => 'unique:languages,name|required_if:textLanguage_id,"new"',
                    
            'cantusTitle' => 'unique:cantusses,title|required_if:cantus_id,"new"',
            
            'pdf' => 'required|mimes:pdf',
        ];


        $messages = [
            'title.required' 
                => "Bitte gib einen <span class='emph'>Titel</span> ein.",

            'composer_id.required' 
                => "Bitte wähle eine*n <span class='emph'>Komponist*in</span> aus oder trage eine*n neue*n ein.",
            'composerLastName.required_if' 
                => "Bitte gib den <span class='emph'>Nachnamen de*r Komponist*in</span> an.",
            'composerLastName.unique_with'
                => "Es gibt diese*n <span class='emph'>Komponist*in</span> bereits. Bitte wähle den Namen aus der Liste.",
            'composerBirthYear.required_if' 
                => "Bitte gib das <span class='emph'>Geburtsjahr de*r Komponist*in</span> an.",
            'composerBirthYear.max' 
                => "Das <span class='emph'>Geburtsjahr de*r Komponist*in</span> kann nicht vor dem Sterbejahr liegen.",            
            'composerDeathYear.required_if' 
                => "Bitte gib das <span class='emph'>Sterbejahr de*r Komponist*in</span> an.",
            'composerImage.required_if'
                => "Bitte lade ein <span class='emph'>Bild de*r Komponist*in</span> hoch.",
            'composerImageDescription.required_if' 
                => "Bitte gib eine <span class='emph'>Beschreibung zum Bild de*r Komponist*in</span> an.",                
            'composerImageSource.required_if' 
                => "Bitte gib die <span class='emph'>Quelle zum Bild de*r Komponist*in</span> an.",

            'composerImageLicense.required_if' 
                => "Bitte gib an, unter welcher <span class='emph'>Lizenz das Bild de*r Komponist*in</span> verfügbar ist.",

            'opusTitle.required_if'
                => "Bitte gibt den <span class='emph'>Titel des Opus'</span> an.",
            
            'year.integer' => "Die <span class='emph'>Jahresangabe</span> muss eine Zahl sein.",

            'difficulty_id.required' => "Bitte wähle eine <span class='emph'>Schwierigkeit</span> aus.",
            'epoque_id.required' => "Bitte wähle eine <span class='emph'>Epoche</span> aus oder trage eine neue ein.",
            
            'epoqueName.required_if' => "Bitte gib den <span class='emph'>  Namen der Epoche</span> ein.",
            
            'epoqueName.unique' => "Diese <span class='emph'>Epoche</span> gibt es bereits. Bitte wähle sie aus der Liste aus.",
            
            'instrumentation_id.required' => "Bitte wähle eine <span class='emph'>Besetzung</span> aus oder trage eine neue ein.", 
            
            'instrumentationNumberOfVoices.required_if' => "Bitte gib die <span class='emph'>Stimmenzahl der Besetzung</span> an.",  
               
            'instrumentationName.required_if' => "Bitte gib den <span class='emph'>Namen der Besetzung</span> an.",
            
            'instrumentationName.unique' => "Diese <span class='emph'>Besetzung</span> gibt es bereits. Bitte wähle sie aus der Liste aus.",
            
            'ensemble.required_if' => "Bitte wähle ein <span class='emph'>Ensemble</span> aus oder trage ein neues ein.",
            
            'ensembleName.required_if' => "Bitte gib den Namen des <span class='emph'>Ensembles</span> an.",
            
            'ensembleName.unique' => "Dieses <span class='emph'>Ensemble</span> gibt es bereits. Bitte wähle es aus der Liste aus.", 
            
            'text_id.required' => "Bitte wähle einen <span class='emph'>Text</span> aus oder trage einen neuen ein.",
            'textTitle.required_if' =>  "Bitte gib den <span class='emph'>Titel des Textes</span> ein.",
            'textLanguage_id.required_if' => "Bitte wähle eine <span class='emph'>Sprache des Textes</span> aus oder gib eine neue ein.",
            'textLanguageName.required_if' => "Bitte gib den <span class='emph'>Namen der Sprache des Textes</span> ein.",
            'textLanguageName.unique' => "Diese <span class='emph'>Sprache</span> gibt es bereits. Bitte wähle sie aus der Liste aus.",
            
            'cantusTitle.required_if' =>  "Bitte gib den <span class='emph'>Titel des Cantus</span> an.",
            
            'cantusTitle.unique' => "Diesen <span class='emph'>Cantus</span> gibt es bereits. Bitte wähle ihn aus der Liste aus.",
            
            'pdf.required' => "Bitte lade die <span class='emph'>PDF</span> hoch.",
            
            'pdf.mimes' => "Die Noten sind anscheinend nicht im <span class='emph'>PDF</span>-Format."

      ];

        $validator = Validator::make($request->all(), $rules, $messages);
              
        if ( $validator->fails() ){
            $response = [
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ];
        }
        else {

            /*
             *  STORE PIECE
             */      
                   
            $piece = new Piece;
            $piece['title'] = $request['title'];

            // YEAR
            $piece['year'] = $request['year'];


            // COMPOSER
            if ($request['composer_id'] <>'new') {
            // user chose existing composer from list
                $composer = Person::where('id', $request['composer_id'])->first();
            }
            else { 
            // create a new composer
                $composer_position = Position::where('name','composer')->first();         
                $composer = new Person;
                $composer['firstName'] = $request['composerFirstName'];
                $composer['lastName'] = $request['composerLastName'];
                $composer['interName'] = $request['composerInterName'];
                $composer['birthYear'] = $request['composerBirthYear'];
                $composer['deathYear'] = $request['composerDeathYear'];
                
                if ( $request['composerBirthYearCertainty'] == "true") {
                    $composer['birthYearCertainty'] = 1;
                }
                else {
                    $composer['birthYearCertainty'] = 0;
                }

                if ( $request['composerDeathYearCertainty'] == "true") {
                    $composer['deathYearCertainty'] = 1;
                }
                else {
                    $composer['deathYearCertainty'] = 0;
                }   
                         
                $auxcomposer = $composer;
                $composer->save();
                $composer->positions()->attach($composer_position);
                
            $composerImageFileName = $composer['id'] . ' ' . $composer->fullNameString('lastNameFirst');

            $composerImage_path = $request->file('composerImage')->storeAs('public/images', $composerImageFileName);

            $composerImage = new Image;
                $composerImage['fileName'] = $composerImageFileName;
                $composerImage['description'] = $request['composerImageDescription'];
                $composerImage['source'] = $request['composerImageSource'];
                $composerImage['license'] = $request['composerImageLicense'];    
            $composerImage->person()->associate($composer);
            $composerImage->save();
                
                
            }

            // OPUS
            if ($request['opus_id'] <> '') {
                if ( $request['opus_id'] <> 'new') {
                    $opus = Opus::where('id', $request['opus_id'])->first();
                }
                else {
                    $opus = new Opus;
                    $opus['title'] = $request['opusTitle'];
                    $opus->composer()->associate($composer);
                }
                $piece->opus()->associate($opus);
            }

            // DIFFICULTY
            $difficulty = Difficulty::where('id', $request['difficulty_id'])->first();  
            $piece->difficulty()->associate($difficulty);
            
            // EPOQUE
            if ($request['epoque_id'] <>'new'){
                $epoque = Epoque::where('id', $request['epoque_id'])->first();
            }
            else {
                $epoque = new Epoque;
                    $epoque['name'] = $request['epoqueName'];
            }
            $piece->epoque()->associate($epoque);

            // INSTRUMENTATION
            if ($request['instrumentation_id'] <> 'new') {
                $instrumentation = Instrumentation::where('id', $request['instrumentation_id'])->first();
            }
            else {
                $instrumentation = new Instrumentation;
                    $instrumentation['numberOfVoices'] = $request['instrumentationNumberOfVoices'];
                    $instrumentation['name'] = $request['instrumentationName'];                    
                    if ( $request['ensemble_id'] <> 'new') {
                        $ensemble = Ensemble::where('id', $request['ensemble_id'])->first();
                    }
                    else {
                        $ensemble = new Ensemble;
                            $ensemble_id = $ensemble['id'];
                            $ensemble['name'] = $request['ensembleName'];
                    }
                    $ensemble->save();
                    $instrumentation->ensemble()->associate($ensemble);
            }
            $instrumentation->save();
            $piece->instrumentation()->associate($instrumentation);                 
                        
            // TEXT
            if ($request['text_id'] <> 'new'){
                $text = Text::where('id', $request['text_id'])->first();
            }
            else {
                $text = new Text;
                    $text['title'] = $request['textTitle'];

                    if ($request['textLanguage_id'] <> 'new') {
                        $language = Language::where('id', $request['textLanguage_id'])->first();
                    }
                    else {
                        $language = new Language;
                            $language['name'] = $request['textLanguageName'];
                    }   
                    $language->save();
                    
                    if ($request['lyricist_id'] <> 'new') {
                        $lyricist = Person::where('id', $request['textLyricist_id'])->first();
                    }
                    else {
                        $lyricist = new Person;
                    }
                    $text->lyricist()->associate($lyricist);
                    $text->save();
                    
                    $text->languages()->attach($language);
            }
           $text->push();
           $piece->text()->associate($text);
    
            // CANTUS 
            if ($request['cantus_id'] <>'new'){
                $cantus = Cantus::where('id', $request['cantus_id'])->first();
            }
            else {
                $cantus = new Cantus;
                    $cantus['title'] = $request['cantusTitle'];
                    $cantus->save();
            }            
            
            $piece->save(); 
                                         
            // SHEET
            $sheetFileName =  
                $piece['id'] . ' ' .
                $piece['title'] . ' (' .
                $composer->fullNameString('lastNameFirst') . 
                ').pdf';

            $sheet_path = $request->file('pdf')->storeAs('public/sheets', $sheetFileName);
            $sheet = new Sheet;         
                $sheet['fileName'] = $sheetFileName;
                $sheet['version'] = '1.0';
            $sheet->piece()->associate($piece);
            $sheet->save();

            $piece->composers()->attach($composer);
            $piece->cantusses()->attach($cantus);                   
            $response = [
                'status' => 'success',
                'piece_id' => $piece['id'],
            ];
       }

       return response()->json($response);
   }
  
    public function publishSucces($id){
        return view('piece.published', ['piece_id'=>$id]);
    }
}
