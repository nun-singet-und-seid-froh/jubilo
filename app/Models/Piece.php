<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
  ////////////////////////////////////////////
  //               RELATIONS                //
  ////////////////////////////////////////////
        
  // 1-to-1

    public function sheet(){
      return $this->hasOne('App\Models\Sheet');
    }
        
  // n-to-1

    public function difficulty(){
      return $this->belongsTo('App\Models\Difficulty');
    }

    public function epoque(){
      return $this->belongsTo('App\Models\Epoque');
    }
    
    public function instrumentation(){
      return $this->belongsTo('App\Models\Instrumentation');
    }
            
    public function text(){
      return $this->belongsTo('App\Models\Text');
    }

    public function opus(){
      return $this->belongsTo('App\Models\Opus');
    }

  // 1-to-n
    public function midifiles(){
      return $this->hasMany('App\Models\Midizip');
    }    

    public function recordings(){
      return $this->hasMany('App\Models\Recording');
    }
  
  // n-to-n

    public function cantusses(){
      return $this->belongsToMany('App\Models\Cantus');
    }

    public function composers(){
      return $this->belongsToMany('App\Models\Person', 'composer_piece');
    }

    public function sources(){
      return $this->belongsToMany('App\Models\Source');
    }

    
  ////////////////////////////////////////////
  //               FUNCTIONS                //
  ////////////////////////////////////////////    

	public function getString() {	 
		return $this['title'] . ' [' . $this->composers->first()->fullNameString('firstNameFirst') . ']';
	}

    public function isPublished() {
      if ($this['editionNumber'] == 0) {
        return false;
      }
      return true;
    }
    
    public function visit() {
      $this['visits'] = $this['visits'] + 1;
      $this->save();
    }
    
    public function cantusString() {
        $cantus_array = [];
            foreach ($this->cantusses()->get() as $cantus ) {
                array_push($cantus_array, $cantus['title']);
            }
            return implode(', ', $cantus_array);
    }    
    
    public function passFilter($filter) {
        if ( ($filter['title'] ) and ( $this->title <> $filter['title']) ) {
            return FALSE;
        }
       
        if ( ($filter['composer_id'] ) and ($this->composers->first()->id <> $filter['composer_id'] ) ) {
            return FALSE;
        }
 
        if ( ($filter['difficulty_id'] ) and $this->difficulty['id'] <> $filter['difficulty_id'] ) {
            return FALSE;
        }
        
        if ( ($filter['numberOfVoices'] <> '') and $this->instrumentation['numberOfVoices'] <> $filter['numberOfVoices']) {
            return FALSE;
        }

        if ( ($filter['ensemble_id'] <> '') and $this->instrumentation->ensemble['id'] <> $filter['ensemble_id'] ) {
            return FALSE;
        }

        if ( ($filter['instrumentation_id'] <> '') and $this->instrumentation['id'] <> $filter['instrumentation_id'] ) {
            return FALSE;
        }

        if ( ($filter['lyricist_id']) and $this->text->lyricist['id'] <> $filter['lyricist_id']) {
            return FALSE;
        }

        if ( ($filter['text_id']) and $this->text()->id <> $filter['text_id'] ) {
            return FALSE;
        }
        
        // if the epoque of the piece is a subepoque of the given, check shall pass
    
        if ( 
            ($filter['epoque_id'] <> '') and 
            ($this['epoque_id'] <> $filter['epoque_id'] ) and
            ($this->epoque->super_epoque_id <> $filter['epoque_id'] )
        )
        {
                return FALSE;
        }

        // one piece can have multiple languages
        if ($filter['language_id'] <> '') {
            if ( !( $this->text->languages->contains($filter['language_id']) ) ) {
                return FALSE;             
            }
        }
                
        // one piece can have multiple cantusses
        if ($filter['cantus_id'] <> '') {
            if ( !( $this->cantusses->contains($filter['cantus_id']) ) ) {
                return FALSE;             
            }
        }

        if ( ($filter['opus_id'] <> '') and $this->opus['id'] <> $filter['opus_id']) {
            return FALSE;
        }
        
        // pretext
        // a text is always pretext of its own, hence the third condition
        if ( ($filter['pretext_id'] <> '') and ($this->text->pretext['id'] <> $filter['pretext_id']) and ($this->text['id'] <> $filter['pretext_id']) ){
            return FALSE;
        }
        
        return TRUE; 
    }
}
