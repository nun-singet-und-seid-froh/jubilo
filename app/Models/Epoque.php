<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epoque extends Model
{
  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n    

    public function isSuperEpoqueOf() {
      return $this->hasMany('App\Models\Epoque');
    }

    public function pieces(){
        return $this->hasMany('App\Models\Piece');
    }

    
  // n-to-1

    public function isSubEpoqueOf() {
      return $this->belongsTo('App\Models\Epoque', 'super_epoque_id');
    }
            
  // n-to-n    

    // ...


  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////

    // ...  
}
