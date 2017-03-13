<?php

use Illuminate\Database\Seeder;

class SheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ros_piece = App\Models\Piece::where('title','Es ist ein Ros entsprungen')->first();
        $ros = new App\Models\Sheet;
          $ros->fileName=('Es_ist_ein_Ros_entsprungen_(Distler,_Hugo).pdf');        
        $ros->piece()->associate($ros_piece);
        $ros->save();

        $schiff_piece = App\Models\Piece::where('title','Es kommt ein Schiff, geladen')->first();
        $schiff = new App\Models\Sheet;
          $schiff->fileName=('Es_kommt_ein_Schiff,_geladen_(Reger,_Max).pdf');        
        $schiff->piece()->associate($schiff_piece);
        $schiff->save();

    }
}
