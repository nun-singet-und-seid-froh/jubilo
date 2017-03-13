<?php

use Illuminate\Database\Seeder;

class EnsemblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ssaa = App\Models\Instrumentation::where('name', 'SSAA')->first();
        $satb = App\Models\Instrumentation::where('name', 'SATB')->first();
        $ssatb = App\Models\Instrumentation::where('name', 'SSATB')->first();
                                
        $mixedChoir = new App\Models\Ensemble;
          $mixedChoir->name = 'Gemischter Chor';
        $mixedChoir->save();

        $satb->ensemble()->associate($mixedChoir);
        $satb->save();

        $ssatb->ensemble()->associate($mixedChoir);
        $ssatb->save();
        
        $womensChoir = new App\Models\Ensemble;
          $womensChoir->name = 'Frauenchor';
        $womensChoir->save();

        $mensChoir = new App\Models\Ensemble;
          $mensChoir->name = 'Männerchor';
        $mensChoir->save();

        $ssaa->ensemble()->associate($womensChoir);
        $ssaa->save();        
    }   
}
