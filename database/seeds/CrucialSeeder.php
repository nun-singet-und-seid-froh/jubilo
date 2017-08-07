<?php

use Illuminate\Database\Seeder;

class CrucialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);        
        $this->call(UsersTableSeeder::class);
        
        $this->call(PositionsTableSeeder::class);
        $this->call(DifficultiesTableSeeder::class);        
    }
}
