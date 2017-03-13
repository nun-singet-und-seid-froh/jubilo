<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ensemble extends Model
{
  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////
  
  // 1-to-1

    // ...
            
  // 1-to-n    

    public function instrumentations() {
        return $this->hasMany('App\Models\Instrumentation');
    }
    
  // n-to-1

    // ...
            
  // n-to-n    

    // ...
            
  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////

    // ...
}
