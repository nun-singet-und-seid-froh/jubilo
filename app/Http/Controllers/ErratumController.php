<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Piece;
use App\Models\Erratum;

class ErratumController extends Controller
{
	public function index(){
		$data['erratums'] = Erratum::all();
		$data['erratumStatusses'] = Erratum::getPossibleEnumValues('status');
		return view('erratum.update', ['data' => $data]); 	
	}

    public function create($piece_id){
		$data['pieces'] = Piece::all();
		$data['selected_id'] = $piece_id;
		return view('erratum.create', ['data' => $data]);
	}

    public function store(Request $request){
		$rules = [
			'bar_number' => 'integer',
			'description' => 'required',
			'provider_email' => 'email',
		];
		
        $messages = [
			'bar_number.integer' => "Die Taktnummer muss eine ganze Zahl sein.",
			'description.required' => "Bitte gib eine Beschreibung des Erratums ein.",
			'provider_email.email' => "Die angegebene Email-Adresse hat nicht das Format einer korrekten E-Mail-Adresse",
		];

		$validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() ){
            $response = [
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ];
        }
        else { // validation passes
			$erratum = new Erratum();
			$erratum['bar_number'] = $request->bar_number;
			$erratum['voice'] = $request->voice;
			$erratum['description'] = $request->description; 
			$erratum['provider_email'] = $request->provider_email;
			$erratum['piece_id'] = $request['piece_id'];
			// $piece = Piece::find($request['piece_id']);
			$erratum->status = "submitted";
			// $erratum->piece()->associate($piece);
			$erratum->push();

			$response = [
                'status' => 'success',
				'erratumId' => $erratum->id,
				'pieceId' => $request['piece_id'],
            ];
        }
		return $response;
	}

	public function update(Request $request){
		$erratum = Erratum::find($request['id']);
		$erratum['status'] = $request['status'];
		$erratum->save();

		$response = [
       		'status' => 'success',
			'erratumStatus' => $erratum['status'],
        ];
		return $response;
	}
}
