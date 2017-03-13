<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
  ////////////////////////////////////
  //             RELATIONS          //
  ////////////////////////////////////
      
  // 1-to-1
    
  // 1-to-n
  
    public function lyricist() {
      return $this->belongsTo('App\Models\Person','lyricist_id');
    }
  
    public function preText(){
      return $this->belongsTo('App\Models\Text', 'preText_id');
    }

  // n-to-1
  
    public function derivates(){
      return $this->hasMany('App\Models\Text', 'preText_id');
    }
    
  // n-to-n
    
    public function languages() {
      return $this->belongsToMany('App\Models\Language');
    }
    
  ////////////////////////////////////
  //           FUNCTIONS            //
  ////////////////////////////////////
  
    public function languageString() {
        $language_array = [];
            foreach ($this->languages()->get() as $language) {
                array_push($language_array, $language['name']);
            }
            return implode(', ', $language_array);
    }

    public function root() {   // get the most basal preText of this text
        if ( $this['preText_id'] <> 0 ){
            return $this->preText->root();
        }
        else {
            return $this;
        }
    }  
}
