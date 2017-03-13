<?php

use Illuminate\Database\Seeder;

class MidifilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ros_sopran = new App\Models\Midifile;
            $ros_sopran['title'] = 'Es_ist_ein_Ros_entsprungen_(Distler,_Hugo)-Sopran';
        $ros_sopran->save();    
    }
}
