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
  
    public function pretext(){
           return $this->belongsTo('App\Models\Text', 'pretext_id');
    }
    

  // n-to-1
  
    public function derivates(){
      return $this->hasMany('App\Models\Text', 'pretext_id');
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
        if ( $this->pretext()->first() ){
            return $this->pretext()->root();
            Log::info($this['title'] . 'has a pretext');
        }
        else {
            return $this;
            Log::infof($this['title'] . 'is root');
        }
    }  
}
