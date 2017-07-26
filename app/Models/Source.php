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

  ////////////////////////////////////
  //           FUNCTIONS            //
  ////////////////////////////////////

    public function path() {
      return ('/storage/sources/' . $this['fileName']);
    }
      
    public function getHTMLString() {
        $sourceString = "";
        
        if ( $this['editors']) {
            $sourceString .=$this['editors'] . ': ' ;
        }
        
        $sourceString .='<i>' . $this['title'] . '</i>. ';
        
        if ( $this['publisherAddress']) {
            $sourceString .=$this['publisherAddress'] . ', ' ;
        }
        
        if ( $this['publisher']) {
            $sourceString .=$this['publisher'] . ' ' ;
        }
        
        if ( $this['year']) {
            $sourceString .='(' . $this['year'] . ')' ;
        }
        
        if ( $this['fileName'] and $this['isPubliclyAvailable']) {
            $sourceString ='<a href="' . $this->path() . '" title="' . $this['license'] . '" target="_blank">' . $sourceString . '</a>';
        }
        else {
            if ( $this['url']) {
                $sourceString ='<a href="' . $this['url'] . '" target="_blank" class="external">' . $sourceString . '</a>';
            }
        }
       
        if ( $this['comment']) {
            $sourceString .=' [' . $this['comment'] . ']' ;
        }

        return $sourceString;
    }
  
}
