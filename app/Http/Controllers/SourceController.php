<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use App\Models\Source;

class SourceController extends Controller {

    public function create() {
		$data['sources'] = Source::all();        
		return view('source.create', ['data'=> $data]);
    }

    public function store(Request $request) {
        $currentUser = Auth::user();
        Log::info('USER ' . $currentUser['email'] . ' @@ SourceController@store ...');

        $source = new Source;
        $source['title'] = $request['title'];
        $source['editors'] = $request['editors'];

        $source['year'] = $request['year'];
        $source['publisher'] = $request['publisher'];
        $source['publisherAddress'] = $request['publisherAddress'];
        $source['url'] = $request['url'];
        $source['comment'] = $request['comment'];
        $source['license'] = $request['license'];
        $source['isPubliclyAvailable'] = $request['isPubliclyAvailable'];
        $source['library'] = $request['library'];
        $source['signature'] = $request['signature'];

	if ( $request['superSource_id'] <> "") {
	    $superSource = Source::findOrFail($request['superSource_id']);
	    
	    $source->isSubSourceOf()->associate($superSource);
	}

        if ($request->hasFile('scan')) {
            $sourceFileName = $request['editors'] . ': '
              . $request['title'] . '. '
              . $request['publisherAddress'] . ' '
              . $request['publisher'] . ' ('
              . $request['year'] . ').pdf';
            $source_path = $request['scan']->storeAs('public/sources', $sourceFileName);
            $source['fileName'] = $sourceFileName;
        }
        
        $source->push();
        $response = [
            'status' => 'success',
        ];
        return $response;
    }
    
    public function created() {
        return view('source.created');
    }
    
    public function index() {
        $sources = Source::all();
        return view('source.index', ['sources' => $sources]);
    }
}   
