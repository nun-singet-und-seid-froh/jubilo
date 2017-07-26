<?php

use Illuminate\Database\Seeder;

class MidizipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ros_sopran = new App\Models\Midizip;
            $ros_sopran['title'] = 'Es_ist_ein_Ros_entsprungen_(Distler,_Hugo)-Sopran';
        $ros_sopran->save();    
    }
}
