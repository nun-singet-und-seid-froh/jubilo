<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cantus extends Model
{
    protected $table = 'cantusses';

  /////////////////////////////////
  //         RELATIONS           //   
  /////////////////////////////////

  // 1-to-1

    // ...
            
  // 1-to-n

    public function derivates() {
      return $this->hasMany('App\Models\Cantus');
    }

    public function sources() {
      return $this->belongsToMany('App\Models\Source');
    }

  // n-to-1

    public function root() {
      return $this->belongsTo('App\Models\Cantus');
    }    
        
  // n-to-n

    public function composers() {
      return $this->belongsToMany('App\Models\Person', 'composer_id');
    }

    public function pieces() {
      return $this->belongsToMany('App\Models\Piece');
    }

  /////////////////////////////////
  //         FUNCTIONS           //   
  /////////////////////////////////

    // ...        
}
