<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////

  // 1-to-n-relations
    
    //..
    
  // n-to-1-relations
        
    //..
        
  // n-to-n-relations
    
    public function texts() {
      return $this->belongsToMany('App\Models\Text');
    }
    
  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////

    //..  
}
