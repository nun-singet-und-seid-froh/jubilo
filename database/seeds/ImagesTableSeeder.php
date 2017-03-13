<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no_image = new App\Models\Image;
          $no_image->fileName = 'no_image.jpg';
          $no_image->description = 'no image available';
          $no_image->license = '';
          $no_image->source = '';
        $no_image->save();
                  
        $distler_image = new App\Models\Image;
          $distler_image->fileName = 'Hugo_Distler.jpg';
          $distler_image->description = 'Hugo Distler, 1942';
          $distler_image->license = 'CC-BY-SA 3.0';
          $distler_image->source = 'https://de.wikipedia.org/wiki/Hugo_Distler#/media/File:Hugo_Distler.jpg';
        $distler_image->save();
        
        $reger_image = new App\Models\Image;
          $reger_image->fileName = 'Max_Reger.jpg';
          $reger_image->description = 'Max Reger, 1913';
          $reger_image->license = 'CC-BY-SA 3.0';
          $reger_image->source = 'https://de.wikipedia.org/wiki/Max_Reger#/media/File:Max_Reger_1913.jpg';
        $reger_image->save();

        $spee_image = new App\Models\Image;
          $spee_image->fileName = 'Friedrich_Spee.jpg';
          $spee_image->description = 'Friedrich Spee, nach 1634';
          $spee_image->license = 'CC-BY-SA 3.0';
          $spee_image->source = 'https://commons.wikimedia.org/wiki/File:Fridericus_Spee_SJ.jpg';
        $spee_image->save();

        $brahms_image = new App\Models\Image;
          $brahms_image->fileName = 'Johannes_Brahms.jpg';
          $brahms_image->description = 'Johannes Brahms, nach 1853';
          $brahms_image->license = 'CC-BY-SA 3.0';
          $brahms_image->source = 'https://en.wikipedia.org/wiki/Johannes_Brahms#/media/File:Johannes_Brahms_1853.jpg';
        $brahms_image->save();
                  
    }
}
