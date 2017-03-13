<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class TextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $heiland = new App\Models\Text;
            $heiland['title'] = 'O Heiland, reiß die Himmel auf';
        $heiland->save();    

        $himmel = new App\Models\Text;
            $himmel['title'] = 'Vom Himmel hoch';
        $himmel->save();    

        
        $in_dulci = new App\Models\Text;
            $in_dulci['title'] = 'In dulci jubilo';
        $in_dulci->save();
        
        $ros = new App\Models\Text;
            $ros['title'] = 'Es ist ein Ros entsprungen';    
        $ros->save();
        
        $reis = new App\Models\Text;
            $reis['title'] = 'Es ist ein Reis entsprungen';
            $reis->preText()->associate($ros);
        $reis->save();
    //    $ros = Text::where('title','Es ist ein Ros entsprungen')->first();

        
        $schiff = new App\Models\Text;
            $schiff['title'] = 'Es kommt ein Schiff, geladen';
        $schiff->save();    
    }
}
