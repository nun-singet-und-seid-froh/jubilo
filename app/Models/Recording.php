<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n    

    // ...
    
  // n-to-1

    public function piece(){
        return $this->belongsTo('App\Model\Piece');
    }
            
  // n-to-n    

    // ...
    
  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////

    // ...
}
