<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(ImagesTableSeeder::class);      
        $this->call(PersonsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(PiecesTableSeeder::class);
        $this->call(SheetsTableSeeder::class);
        $this->call(EpoquesTableSeeder::class);        

        $this->call(InstrumentationsTableSeeder::class);
        $this->call(EnsemblesTableSeeder::class);
        $this->call(CantussesTableSeeder::class);
        $this->call(OpussesTableSeeder::class);        
        $this->call(SourcesTableSeeder::class);        
        $this->call(LanguagesTableSeeder::class);        
        $this->call(TextsTableSeeder::class);        

        $this->call(MidifilesTableSeeder::class);        
        $this->call(DifficultiesTableSeeder::class);
        
        $this->call(AttachmentsSeeder::class);        
    }
}
