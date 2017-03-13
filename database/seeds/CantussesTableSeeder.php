<?php

use Illuminate\Database\Seeder;
use App\Models\Person;

class CantussesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ros = new App\Models\Cantus;
          $ros['title'] = 'Es ist ein Ros entsprungen';
        $ros->save();
        
        $ros_piece = App\Models\Piece::where('title','Es ist ein Ros entsprungen')->first();
        $ros_piece->cantusses()->attach($ros);
        
        $heiland = new App\Models\Cantus;
          $heiland['title'] = "O Heiland, reiß die Himmel auf";
        $heiland->save();

        $heiland_piece = App\Models\Piece::where('title','O Heiland, reiß die Himmel auf')->first();
        $heiland_piece->cantusses()->attach($heiland);
    }
}
