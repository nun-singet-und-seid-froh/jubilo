<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EnumIndexer;   

class Erratum extends Model
{
    public $table = "erratum";
 	
	use EnumIndexer;

  ////////////////////////////////////////////
  //               RELATIONS                //
  ////////////////////////////////////////////

  // 1-to-1
            
  // 1-to-n    

    
  // n-to-1
	public function piece() {
		return $this->belongsTo('App\Models\Piece', 'piece_id');
    }
  // n-to-n    

    
  ////////////////////////////////////////////
  //               FUNCTIONS                //
  ////////////////////////////////////////////

	public function change() {
	// this mimics the push() method of class Model, but is additionally sending
	// notifications to the admin and the e-mail associated with the erratum informing #
	// about the current status of the erratum 

        if (! $this->save()) {
            return false;
        }
        // To sync all of the relationships to the database, we will simply spin through
        // the relationships and save each model via this "push" method, which allows
        // us to recurse into all of these nested relations for the model instance.
        foreach ($this->relations as $models) {
            $models = $models instanceof Collection
                        ? $models->all() : [$models];
            foreach (array_filter($models) as $model) {
                if (! $model->push()) {
                    return false;
                }
            }
        }
	
        return true;
    }
}
