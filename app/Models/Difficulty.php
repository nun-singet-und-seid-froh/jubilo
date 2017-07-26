<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    /////////////////////////////////
    //         RELATIONS           //   
    /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n    

    // ...
    
  // n-to-1

    // ...
            
  // n-to-n    
    public function pieces(){
        return $this->hasMany('App\Models\Piece');
    }   
}
