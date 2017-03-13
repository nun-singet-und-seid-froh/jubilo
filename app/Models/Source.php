<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{

  ////////////////////////////////////
  //             RELATIONS          //
  ////////////////////////////////////
      
  // 1-to-1
  
    public function sheet() {
      return $this->belongsTo('App\Models\Sheet');
    }
    
  // 1-to-n
  
    // ...

  // n-to-1

    // ...
  
  // n-to-n    
    public function pieces() {
      return $this->belongsToMany('App\Models\Piece');
    }
    
    public function cantusses() {
      return $this->belongsToMany('App\Models\Cantus');
    }
    
    public function editors() {
      return $this->belongsToMany('App\Models\Person', 'editor_id');
    }
    
    
}
