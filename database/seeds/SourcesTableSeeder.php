<?php

use Illuminate\Database\Seeder;
use App\Models\Source;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ros_piece = App\Models\Piece::where('title','Es ist ein Ros entsprungen')->first();
        
        $wgag = new Source;
           $wgag['title'] = 'Die Weihnachtsgeschichte';
           $wgag['editors'] = 'Hugo Distler';
           $wgag['publisher'] = 'Bärenreiter';
           $wgag['publisherAddress'] = 'Kassel';
           $wgag['year'] = 1933;
           $wgag['comment'] = 'Erstausgabe';
           $wgag['license'] = 'gemeinfrei';
           $wgag['url'] = "http://www.jonathan-scholbach.de";
           $wgag['isPubliclyAvailable'] = TRUE;           
        $wgag->save();
        $ros_piece->sources()->attach($wgag);
        
        $wg = new Source;
           $wg['title'] = 'Die Weihnachtsgeschichte';
           $wg['editors'] = 'Hugo Distler';
           $wg['publisher'] = 'Bayrische Staatsbibliothek';
           $wg['publisherAddress'] = '';
           $wg['comment'] = 'Autograph';
           $wg['license'] = 'gemeinfrei';
           $wg['url'] = "http://daten.digitale-sammlungen.de/~db/0006/bsb00068297/images/";
           $wg['isPubliclyAvailable'] = TRUE;           
        $wg->save();
                          
        $ros_piece->sources()->attach($wg);
    }
}
