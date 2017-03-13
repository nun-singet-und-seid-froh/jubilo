<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
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
  
    public function isSource() {
      return $this->belongsTo('App\Models\Sheet');
    }
      
  // n-to-n
    
    // ...
    
  ////////////////////////////////////
  //           FUNCTIONS            //
  ////////////////////////////////////
    
    public function path() {
      return ('/storage/sheets/' . $this['fileName']);
    }
}
