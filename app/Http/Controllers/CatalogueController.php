<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Piece;
use App\Models\Person;
use App\Models\Epoque;
use App\Models\Instrumentation;
use App\Models\Difficulty;
use App\Models\Language;
use App\Models\Text;
use App\Models\Cantus;
use App\Models\Ensemble;
use App\Models\Opus;
use Illuminate\Contracts\Pagination;

class CatalogueController extends Controller
{
    public function show()
    {
        // fetch all published pieces
        $data['pieces'] = Piece::orderBy('title')->get();
        $data['count'] = count($data['pieces']);

        // fetch all persons that are composers of a published piece

        $data['composers'] = Person::has('pieces')->orderBy('lastName')->get();
        
        $data['lyricists'] = Person::has('texts')->orderBy('lastName')->get();

        // fetch all Epoques with at least one published piece

        $data['epoques'] = Epoque::has('pieces')->get();        
        
        // instrumentations, count of Voices and gender
        $data['instrumentations'] = Instrumentation::all();
       
        $data['opusses'] = Opus::all();
        
        $data['ensembles'] = [];                
        foreach ( Instrumentation::all() as $key => $instrumentation) {
            if ( !( in_array([
                'id' => $instrumentation->ensemble['id'],
                'name' => $instrumentation->ensemble['name']
                ],
                $data['ensembles']))){
                array_push($data['ensembles'], [
                        'id' => $instrumentation->ensemble['id'], 
                        'name' => $instrumentation->ensemble['name'], 
                ]);
            }
        }        

        $data['numberOfVoices'] = [];
        foreach ( Instrumentation::all() as $key => $instrumentation ) {
            if ( ! ( in_array($instrumentation['numberOfVoices'], $data['numberOfVoices'] ) ) ){
                array_push($data['numberOfVoices'], $instrumentation['numberOfVoices'] );
            }
        }

        $data['difficulties'] = Difficulty::has('pieces')->get();
        $data['languages'] = Language::orderBy('name')->get();
        
        $data['cantusses'] = Cantus::all();
        $data['texts'] = Text::all();
        $data['pretexts'] = Text::where('pretext_id', 0)->orderBy('title')->get();
        
        return view('catalogue.show', ['data'=>$data]);
    }
    
    /*
     *    FILTER
     */
     
    public function filter(Request $request)
    {
        // filter the pieces matching the criteria given in the $request
        $pieces = Piece::orderBy('title')->get();
        $filtered_pieces = $pieces->filter(function($piece, $key) use ($request){
            return $piece->passFilter([
               'title' => $request->title,
               'composer_id' => $request->composer_id,
               'opus_id' => $request->opus_id,   
               'epoque_id' => $request->epoque_id,

               'lyricist_id' => $request->lyricist_id,
               'text_id' => $request->text_id,
               'pretext_id' => $request->pretext_id,
               'language_id' => $request->language_id,

               'difficulty_id' => $request->difficulty_id,
               'numberOfVoices' => $request->numberOfVoices,
               'ensemble_id' => $request->ensemble_id,
               'instrumentation_id' => $request->instrumentation_id,

               'cantus_id' => $request->cantus_id,  
           ]);
        });
 
        // prepare the data for the view
        foreach ($filtered_pieces as $piece) {
            $piece->composer = $piece->composers->first()->fullNameString('firstNameFirst');
            $piece->ensemble =  $piece->instrumentation->ensemble['name'];
            $piece->numberOfVoices = $piece->instrumentation['numberOfVoices'];
            $piece->difficulty->name = $piece->difficulty['name'];
            $piece->epoque->name = $piece->epoque['name'];
            $language_array = [];
            foreach ($piece->text->languages()->get() as $l) {
                array_push($language_array, $l['name']);
            }
            $piece->language = implode(', ', $language_array);
            $piece->link = 'piece/show/' . $piece['id'];
        }
        
        // get a unique list of titles, composers, etc. which are related to the filtered pieces
        $filtered_titles = $filtered_pieces->unique('title')->pluck('title');
        $filtered_composer_ids = [];
        foreach ($filtered_pieces as $piece){
            array_push($filtered_composer_ids, $piece->composers->first()->id);
        }

        $filtered_composers = Person::findMany($filtered_composer_ids);
        foreach ($filtered_composers as $composer){
            $composer['string'] = $composer->fullNameString('lastNameFirst') . ' (' . $composer->dateString() . ')';
        }                    
        $filtered_opusses = Opus::findMany($filtered_pieces->unique('opus_id')->pluck('opus_id'));
        $filtered_epoques = Epoque::findMany($filtered_pieces->unique('epoque_id')->pluck('epoque_id'));
        
        $filtered_difficulties = Difficulty::findMany($filtered_pieces->unique('difficulty_id')->pluck('difficulty_id'));
        $filtered_instrumentations = Instrumentation::findMany($filtered_pieces->unique('instrumentation_id')->pluck('instrumentation_id'));
        $filtered_ensembles = Ensemble::findMany($filtered_instrumentations->unique('ensemble_id')->pluck('ensemble_id'));
        foreach ($filtered_ensembles as $ensemble) {
            $ensemble['name'] = $ensemble['name'];
        }
        
        $filtered_numberOfVoices = collect([]);
        foreach ($filtered_instrumentations as $instrumentation) {
            $filtered_numberOfVoices->push($instrumentation['numberOfVoices']);
        }
        $filtered_numberOfVoices = $filtered_numberOfVoices->unique();

        $filtered_cantusses = collect([]);
        foreach ($filtered_pieces as $piece) {
            foreach ($piece->cantusses()->get() as $cantus){
                $filtered_cantusses->push($cantus);
            }
        }
        $filtered_cantusses = $filtered_cantusses->unique();
        
        $filtered_texts = Text::findMany($filtered_pieces->unique('text_id')->pluck('text_id'));
        
        Log::info('filtered texts: ' . $filtered_texts);
        
        $filtered_languages = collect([]);
        $filtered_pretexts = collect([]);
        Log::info('filter@CatalogueController: $filtered_texts: ' . $filtered_texts);
        
        foreach ($filtered_texts as $text){
             if ($text['pretext_id'] <> 0) {
                $filtered_pretexts->push($text->pretext());
                Log::info('added pretext' . $text->pretext['title']);                
            }
            else {
                $filtered_pretexts->push($text);
                Log::info($text['title'] . ' has no pretext, has been added as root.');
            }
            
            foreach ($text->languages()->get() as $language){
                $filtered_languages->push($language);
            }
        }
        $filtered_languages = $filtered_languages->unique('name');
        // $filtered_pretexts = $filtered_pretexts->unique();
        
        Log::info('filtered pretexts: ' . $filtered_pretexts);
        Log::info('filter@CatalogueController: selected pretext: ' . $request->pretext_id);
        $response = array(
            'status' => 'success',
                          
            'selected_title' => $request->title,
            'selected_composer_id' => $request->composer_id,
            'selected_numberOfVoices' => $request['numberOfVoices'],
            'selected_instrumentation_id' => $request->instrumentation_id,
            'selected_epoque_id' => $request->epoque_id,
            'selected_cantus_id' => $request->cantus_id,
            'selected_ensemble_id' => $request->ensemble_id,
            'selected_language_id' => $request->language_id,
            'selected_opus_id' => $request->opus_id,
            'selected_pretext_id' => $request->pretext_id,
            'selected_difficulty_id' => $request->difficulty_id,                
            
            'pieces' => $filtered_pieces,
            'count' => $filtered_pieces->count(),
            'titles' => $filtered_titles,
            'composers' => $filtered_composers,
            'opusses' => $filtered_opusses,
            'epoques' => $filtered_epoques,
            'difficulties' => $filtered_difficulties,
            'numberOfVoices' => $filtered_numberOfVoices,
            'ensembles' => $filtered_ensembles,
            'instrumentations' => $filtered_instrumentations,
            'cantusses' => $filtered_cantusses,
            'languages' => $filtered_languages,
            'pretexts' => $filtered_pretexts,

              );
          return response()->json($response); 
   }        
}

