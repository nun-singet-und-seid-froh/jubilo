<?php

use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $speyer = new App\Models\Source;
          $speyer->title = 'Das Speyerer Gesangbuch von 1599';
          $speyer->year = 1599;
          $speyer->publisherAddress = 'Speyer';
        $speyer->save();
        
        $ros_cantus = App\Models\Cantus::where('title','Es ist ein Ros entsprungen')->first();
        $ros_piece = App\Models\Piece::where('title','Es ist ein Ros entsprungen')->first();
        
        $ros_cantus->sources()->attach($speyer);
        $ros_piece->sources()->attach($speyer);
    }
}
