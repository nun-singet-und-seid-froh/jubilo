<?php

use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Piece;

class OpussesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distler = Person::where('lastName','Distler')->first();

        $weihnachtsgeschichte = new App\Models\Opus;
            $weihnachtsgeschichte['title'] = "Die Weihnachtsgeschichte";
            $weihnachtsgeschichte['opusNumber'] = "10";     
            $weihnachtsgeschichte->composer()->associate($distler);
        $weihnachtsgeschichte->save();

        $ros = Piece::where('title','Es ist ein Ros entsprungen')->first();
            $ros->opus()->associate($weihnachtsgeschichte); 
        $ros->save();
    }
}
