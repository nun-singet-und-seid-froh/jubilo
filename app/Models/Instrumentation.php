<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrumentation extends Model
{
  /////////////////////////////////
  //          RELATIONS          //   
  /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n    

    // ...
    
  // n-to-1

    public function alias() {
      return $this->belongsTo('App\Models\Instrumentation','alias_id');
    }            

    public function ensemble() {
        return $this->belongsTo('App\Models\Ensemble');
    }

  // n-to-n    

    // ...      
    
  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////
    
    public function href() {
      return route('instrumentation', [ 'id'=>$this['id'] ]);
    }
    
    public function link() {
      return $this->name;
    }  
}
