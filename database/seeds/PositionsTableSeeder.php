<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach( ['composer', 'lyricist', 'editor', 'conductor', 'soloist'] as $positionString ){
            $position = new App\Models\Position;
                $position['name'] = $positionString;
            $position->save();    
        }        
    }
}
