<?php

use Illuminate\Database\Seeder;

class InstrumentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {                   
        $ssaa = new App\Models\Instrumentation;
          $ssaa->name = 'SSAA';
          $ssaa->numberOfVoices = 4;
        $ssaa->save();  
   
        $satb = new App\Models\Instrumentation;
          $satb->name = 'SATB';
          $satb->numberOfVoices = 4;          
        $satb->save();

        $ssatb = new App\Models\Instrumentation;
          $ssatb->name = 'SSATB';
          $ssatb->numberOfVoices = 5;
        $ssatb->save();
        
    }
}
