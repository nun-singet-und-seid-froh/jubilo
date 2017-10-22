<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class Person extends Model
{
	public $table = "persons";
    
  ////////////////////////////////////////////
  //               RELATIONS                //
  ////////////////////////////////////////////

  // 1-to-1

    public function image() {
      return $this->hasOne('App\Models\Image', 'person_id');
    }
            
  // 1-to-n    

    public function cantusses() {
      return $this->hasMany('App\Models\Cantus', 'person_id');
    }

    public function isEditorOf() {
      return $this->hasMany('App\Models\Source', 'editor_id');
    }

    public function texts() {
      return $this->hasMany('App\Models\Text', 'lyricist_id');
    }

    public function isConductorOf() {
      return $this->belongsToMany('App\Models\Recording', 'conductor_id');
    }

    public function isSoloistOf() {
      return $this->hasMany('App\Models\Recording', 'soloist_id');
    }

    public function opusses() {
      return $this->hasMany('App\Models\Opus');
    }

    public function pieces() {
      return $this->belongsToMany('App\Models\Piece', 'composer_piece');
    }
    
  // n-to-1

    public function alias() {
        return $this->belongsTo('App\Models\Person', 'alias_id');
    }
            
  // n-to-n    

    public function compilations() {
      return $this->belongsToMany('App\Models\Compilation');
    }
    
    public function positions() {
        return $this->belongsToMany('App\Models\Position');
    }
    
  ////////////////////////////////////////////
  //               FUNCTIONS                //
  ////////////////////////////////////////////
    
    public function setPosition($positionString) {
        $position = Position::where('name', $positionString)->first();
        if ( $position ) {
            $this->positions()->attach($position);
        }
        else {
            return "Error in function setPosition() in Person.php";
        } 
    }
    
    public function href() 
    {
      return '/person/show/' . $this['id'];
    }
    
    public function fullNameString($nameOrder) {
      $firstName = $this['firstName'];
      $lastName = $this['lastName'];
      
      if ($this['interName']) {
        $interName = ' ' . $this['interName'] . ' ';
      }
      else {
        $interName = ' ';
      }
      
      if ( $nameOrder == "lastNameFirst") {
        return $interName . $lastName . ', ' . $firstName;
      }
      return $firstName . $interName . $lastName;
    }
    
    public function dateString() {
      $birthDate = certaintyString($this['birthYear'], $this['birthYearCertainty']); 
      $deathDate = certaintyString($this['deathYear'], $this['deathYearCertainty']);
      
      return concatenateDates($this['birthYear'], $this['deathYear']);  
    }
    
    public function hintString()
    {
        $aliasString = '';
        $aliases = Person::where('alias_id', $this['id'])->get();
        if ( $aliases->first() ) {
            $aliasString = '| alias: ';
            foreach ( $aliases as $alias ) {
                // missing: insert a separator between each entry, but not after the last
                $aliasString = $aliasString . $alias->fullNameString("firstNameFirst") . ', ';
            }
        }
       
        return $this->dateString() . ' ' . $aliasString;
    }
}
