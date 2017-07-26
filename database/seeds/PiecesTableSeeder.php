<?php

use Illuminate\Database\Seeder;
use App\Models\Person;

class PiecesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $distler = App\Models\Person::where('lastName','Distler')->first();
      $reger = App\Models\Person::where('lastName','Reger')->first();
      $brahms = Person::where('lastName', 'Brahms')->first();
      $schroeter = Person::where('lastName', 'Schröter')->first();                  
            
      $ros = new App\Models\Piece;
        $ros['title'] = "Es ist ein Ros entsprungen";
        $ros['editionNumber'] = 1;
        $ros['sourcecode'] = "https://github.com/nun-singet-und-seid-froh/nun-singet-und-seid-froh/tree/scores/es_ist_ein_ros_entsprungen/distler%2C_hugo/scores/Es_ist_ein_Ros_entsprungen/Es_ist_ein_Ros_entsprungen_(Distler%2C_Hugo)";
        $ros['year'] = 1933;
      $ros->save();
      $ros->composers()->attach($distler);
      
      $schiff = new App\Models\Piece;
        $schiff['title'] = "Es kommt ein Schiff, geladen";
        $schiff['editionNumber'] = 2;
        $schiff['sourcecode'] = "https://github.com/nun-singet-und-seid-froh/nun-singet-und-seid-froh/tree/master/scores/Es_kommt_ein_Schiff/Es_kommt_ein_Schiff_(Reger%2C_Max)";
      $schiff->save();
      $schiff->composers()->attach($reger);

      $himmel = new App\Models\Piece;
        $himmel['title'] = "Vom Himmel hoch";
        $himmel['editionNumber'] = 3;
      $himmel->save();
      $himmel->composers()->attach($reger);

      $heiland = new App\Models\Piece;
        $heiland['title'] = "O Heiland, reiß die Himmel auf";
      $heiland->save();
      $heiland->composers()->attach($brahms);
      
      $in_dulci = new App\Models\Piece;
        $in_dulci['title'] = "In dulci jubilo";
        $in_dulci['editionNumber'] = 3;        
      $in_dulci->save();
      $in_dulci->composers()->attach($schroeter);
    }
}
