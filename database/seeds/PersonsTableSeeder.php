<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $distler = new App\Models\Person;
        $distler->firstName = 'Hugo';
        $distler->lastName = 'Distler';
        $distler->birthYear = 1908;
        $distler->deathYear = 1942;
      $distler->save();

      $reger = new App\Models\Person;
        $reger->firstName = 'Max';
        $reger->lastName = 'Reger';
        $reger->birthYear = 1873;
        $reger->deathYear = 1916;
      $reger->save();

      $brahms = new App\Models\Person;
        $brahms->firstName = 'Johannes';
        $brahms->lastName = 'Brahms';
        $brahms->birthYear = 1833;
        $brahms->deathYear = 1897;
      $brahms->save();
            
      $spee = new App\Models\Person;
        $spee->firstName = 'Friedrich';
        $spee->lastName = 'Spee';
        $spee->birthYear = 1591;
        $spee->deathYear = 1635;
      $spee->save();
      
      $schroeter = new App\Models\Person;
        $schroeter->firstName = 'Leonhart';
        $schroeter->lastName = 'Schröter';
        $schroeter->birthYear = 1532;
        $schroeter->birthYearCertainty = false;
        $schroeter->deathYear = 1601;
        $schroeter->deathYearCertainty = false;
      $schroeter->save();
      
      $schroeter_one = new App\Models\Person;
        $schroeter_one->firstName = 'Leonhard';
        $schroeter_one->lastName = 'Schröter';
        $schroeter_one->alias()->associate($schroeter);
      $schroeter_one->save();

      $schroeter_two = new App\Models\Person;
        $schroeter_two->firstName = 'Leonhardt';
        $schroeter_two->lastName = 'Schröter';
        $schroeter_two->alias()->associate($schroeter);
      $schroeter_two->save();
      
      $schroeter->save();
      
    }
}
