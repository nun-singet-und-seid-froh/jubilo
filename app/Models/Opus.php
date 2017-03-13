<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opus extends Model
{
    protected $table = 'opusses';
    
  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n    
    public function pieces() {
        return $this->hasMany('App\Models\Piece');
    }
    // ...
    
  // n-to-1

    public function composer() {
        return $this->belongsTo('App\Models\Person', 'composer_id');
    }
            
  // n-to-n    

    // ...
    
  /////////////////////////////////
  //         FUNCTIONS           //   
  ///////////////////////////////// 
  
    // ...
}
