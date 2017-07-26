<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midizip extends Model
{
  ////////////////////////////////////
  //             RELATIONS          //
  ////////////////////////////////////
      
  // 1-to-1
    
    public function piece() {
      return $this->belongsTo('App\Models\Piece');
    }
  
  // 1-to-n    

    // ...
        
  // n-to-1
  
   // ...
      
  // n-to-n
    
    // ...
    
  ////////////////////////////////////
  //           FUNCTIONS            //
  ////////////////////////////////////
    
    public function path() {
      return ('/storage/midi/' . $this['fileName']);
    }
}
