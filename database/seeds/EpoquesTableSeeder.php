<?php

use Illuminate\Database\Seeder;
use App\Models\Piece;


class EpoquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        $barock = new App\Models\Epoque;
          $barock->name = 'Barock';
        $barock->save();

        $fbarock = new App\Models\Epoque;
          $fbarock->name = 'Frühbarock';
          $fbarock->isSubEpoqueOf()->associate($barock, 'super_epoque_id');
        $fbarock->save();
    
        $sbarock = new App\Models\Epoque;
          $sbarock->name = 'Spätbarock';
          $sbarock->isSubEpoqueOf()->associate($barock, 'super_epoque_id');
        $sbarock->save();  

        $renaissance = new App\Models\Epoque;
          $renaissance->name = 'Renaissance';
        $renaissance->save();
            
        $romantik = new App\Models\Epoque;
          $romantik->name = 'Romantik';
        $romantik->save();

        $fromantik = new App\Models\Epoque;
          $fromantik->name = 'Frühromantik';
          $fromantik->isSubEpoqueOf()->associate($romantik, 'super_epoque_id');
        $fromantik->save();

        $sromantik = new App\Models\Epoque;
          $sromantik->name = 'Spätromantik';
          $sromantik->isSubEpoqueOf()->associate($romantik, 'super_epoque_id');
        $sromantik->save();

        $moderne = new App\Models\Epoque;
          $moderne->name = 'Moderne';
        $moderne->save();



        $ros = Piece::where('title','Es ist ein Ros entsprungen')->first();
          $ros->epoque()->associate($moderne);
        $ros->save();
        
        $schiff = Piece::where('title','Es kommt ein Schiff, geladen')->first();
          $schiff->epoque()->associate($sromantik);
        $schiff->save();
        
        $in_dulci = Piece::where('title','In dulci jubilo')->first();
            $in_dulci->epoque()->associate($renaissance);
        $in_dulci->save();    
        
    }
}
