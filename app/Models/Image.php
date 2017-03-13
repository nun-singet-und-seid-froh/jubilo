<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  ////////////////////////////////////
  //             RELATIONS          //
  ////////////////////////////////////

  // 1-to-1

    public function person(){
      return $this->belongsTo('App\Models\Person');
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
    
    public function hint() {
      return (
              $this->description . '; Quelle: ' .
              $this->source . '; Lizenz: ' .
              $this->license
             );
    }
    
    public function path() {
      return ('/storage/images/' . $this['fileName']);
    }
}
