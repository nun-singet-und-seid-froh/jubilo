<?php

use Illuminate\Database\Seeder;

class DifficultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $sleicht = new App\Models\Difficulty;
            $sleicht['order'] = 0;
            $sleicht['name'] = 'sehr leicht';
            $sleicht['explanation'] = 'Homophone Stücke für maximal 4 Stimmen, mit einfacher Harmonik und Rhythmik.';
        $sleicht->save();    
        
        $leicht = new App\Models\Difficulty;
            $leicht['order'] = 100;
            $leicht['name'] = 'leicht';
            $leicht['explanation'] = 'Einfachere polyphone Stücke mit maximal 4 Stimmen, mit einfacher Harmonik und Rhythmik.';            
        $leicht->save();
        
        $mschwer = new App\Models\Difficulty;
            $mschwer['order'] = 300;
            $mschwer['name'] = 'mittelschwer';
            $mschwer['explanation'] = 'Polyphone Stücke mit eher einfacher Harmonik und Rhythmik.';
        $mschwer->save();
        
        $schwer = new App\Models\Difficulty;
            $schwer['order'] = 400;
            $schwer['name'] = 'schwer';
            $schwer['explanation'] = 'Polyphone mit vielen Stimmen, mit anspruchsvoller Harmonik oder Rhythmik.';
        $schwer->save();
        
        $sschwer = new App\Models\Difficulty;
            $sschwer['order'] = 500;
            $sschwer['name'] = 'sehr schwer';
            $schwer['explanation'] = 'Polyphone mit vielen Stimmen, mit anspruchsvoller Harmonik und Rhythmik, ggf. außergewöhnlicher Stimmumfang in den Einzelstimmen.';
        $sschwer->save();       
    }
}
