<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use App\Models\Epoque;

class EpoquesController extends Controller
{
    public function index(){
        $epoques = Epoque::all();
        return view('epoque.update', ['epoques' => $epoques]);
    }
    
    public function store($name, $superEpoqueId, $rank) {
        if (!Auth::user()) {
            Log::info('ERROR: Unauthenticated User @@ store@EpoquesController');
            return 'ERROR: Unauthenticated User @@ store@EpoquesController';
        }
        else {
            Log::info('USER ' . Auth::user()->email . ' @@ store@EpoquesController');
        }
        $epoque = New Epoque;
            if ( $name ) {
                $epoque['name'] = $name;
            }
            else {
                Log::info('ERROR: No epoque name given!');
            }
            
            if ( $superEpoqueID ) {
                $superEpoque = Epoque::where('id', $superEpoqueID);
                if ( $superEpoque ) {
                    $epoque->associate($superEpoque);
                }
                else {
                    Log::info('ERROR: superEpoque with id ' . $superEpoqueID . ' not found!');
                }
            }
            if ( $rank ) {
                $epoque['rank'] = $rank;
            }
            else {
                Log::info('ERROR: No rank given!');
            }

            $epoque->save();
            Log::info('Epoque ' . $epoque . ' successfully stored');
    }
    
    public function update(Request $request) {
        $editor = Auth::user();
        Log::info ('EDITOR ' . $editor['email'] . ' @@ update@EpoquesController ...');
        
        $updateEpoques = json_decode($request['epoques'], true);
        foreach ( $updateEpoques as $epoque_id => $updateEpoque) {
            $epoque = Epoque::where('id', $epoque_id)->first();
            $epoque['name'] = $updateEpoque['name'];
            $epoque['rank'] = $updateEpoque['rank'];
            $epoque->push();
            if ( $updateEpoque['superEpoque'] <> '') {
                $superEpoque = Epoque::where('id', $updateEpoque['superEpoque'])->first();
                $epoque->isSubEpoqueOf()->associate($superEpoque);
                $epoque->save();
            }
            else {
                $epoque->isSubEpoqueOf()->dissociate();
                $epoque->save();
            }
       }   
            $response = [
                'status' => 'success',
            ];
            
            return $response;
    }
}
