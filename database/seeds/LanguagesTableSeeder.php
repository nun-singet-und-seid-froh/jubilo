<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $german = new App\Models\Language;
            $german['name'] = 'deutsch';
        $german->save();
        
        $latin = new App\Models\Language;
            $latin['name'] = 'latein';
        $latin->save();

    }
}
