<?php

use Illuminate\Database\Seeder;

class AttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // load persons
          $distler = App\Models\Person::where('lastName','Distler')->first();
          $reger = App\Models\Person::where('lastName','Reger')->first();
          $schroeter = App\Models\Person::where('lastName','Schröter')->first();
          $brahms = App\Models\Person::where('lastName','Brahms')->first();                    
          foreach ( [ $distler, $reger, $brahms, $schroeter] as $person ){
              $person->setPosition('composer');
          }
          
          $spee = App\Models\Person::where('lastName','Spee')->first();
          foreach ( [ $spee, ] as $person ){
              $person->setPosition('lyricist');
          }
          
          //load images
          $schroeter_image = App\Models\Image::where('fileName', 'no_image.jpg')->first();
          $distler_image = App\Models\Image::where('fileName', 'Hugo_Distler.jpg')->first();      
          $reger_image = App\Models\Image::where('fileName', 'Max_Reger.jpg')->first();               
          $brahms_image = App\Models\Image::where('fileName', 'Johannes_Brahms.jpg')->first();
          $spee_image = App\Models\Image::where('fileName', 'Friedrich_Spee.jpg')->first();

          //load pieces 
          $in_dulci_piece = App\Models\Piece::where('title', 'In dulci jubilo')->first();
          $ros_piece = App\Models\Piece::where('title', 'Es ist ein Ros entsprungen')->first();
          $schiff_piece = App\Models\Piece::where('title', 'Es kommt ein Schiff, geladen')->first();
          $himmel_piece = App\Models\Piece::where('title', 'Vom Himmel hoch')->first();
          $heiland_piece =  App\Models\Piece::where('title','O Heiland, reiß die Himmel auf')->first();
                    
          // load epoques
          $moderne = App\Models\Epoque::where('name','Moderne')->first();
          $romantik = App\Models\Epoque::where('name','Romantik')->first();
          $sromantik = App\Models\Epoque::where('name','Spätromantik')->first();
          $renaissance = App\Models\Epoque::where('name','Renaissance')->first();
          
          $in_dulci_text = App\Models\Text::where('title', 'In dulci jubilo')->first();

          // load instrumentations
          $ssaa = App\Models\Instrumentation::where('name','SSAA')->first();
          $satb = App\Models\Instrumentation::where('name','SATB')->first();
          $ssatb = App\Models\Instrumentation::where('name','SSATB')->first();

          // load languages
          $german = App\Models\Language::where('name','deutsch')->first();
          $latin = App\Models\Language::where('name','latein')->first();          
          
          // load texts
          $heiland_text = App\Models\Text::where('title','O Heiland, reiß die Himmel auf')->first();

          $himmel_text = App\Models\Text::where('title','Vom Himmel hoch')->first();

          $in_dulci_text = App\Models\Text::where('title','In dulci jubilo')->first();
          $ros_text = App\Models\Text::where('title','Es ist ein Ros entsprungen')->first();
          $schiff_text = App\Models\Text::where('title','Es kommt ein Schiff, geladen')->first();   

          // load difficulties
          $sleicht = App\Models\Difficulty::where('name','sehr leicht')->first();
          $leicht = App\Models\Difficulty::where('name','leicht')->first();
          $mschwer = App\Models\Difficulty::where('name','mittelschwer')->first();
          $schwer = App\Models\Difficulty::where('name','schwer')->first();
          $sschwer = App\Models\Difficulty::where('name','sehr schwer')->first();
    
          // run attachments and associations

          $in_dulci_piece->text()->associate($in_dulci_text);
          $in_dulci_piece->difficulty()->associate($leicht);
          $in_dulci_piece->instrumentation()->associate($satb);
          $in_dulci_text->languages()->attach($german);
          $in_dulci_text->languages()->attach($latin);
          
          $schiff_piece->epoque()->associate($sromantik);
          $schiff_piece->instrumentation()->associate($ssatb);
          $schiff_piece->text()->associate($schiff_text);
          $schiff_piece->difficulty()->associate($mschwer);          
          $schiff_text->languages()->attach($german);          

          $himmel_piece->epoque()->associate($sromantik);
          $himmel_piece->instrumentation()->associate($ssaa);
          $himmel_piece->text()->associate($himmel_text);
          $himmel_piece->difficulty()->associate($mschwer);          
          $himmel_text->languages()->attach($german);          
          $himmel_text->lyricist()->associate($spee);
          
          $heiland_piece->epoque()->associate($romantik);
          $heiland_piece->instrumentation()->associate($satb);
          $heiland_piece->text()->associate($himmel_text);
          $heiland_piece->difficulty()->associate($mschwer);          
          $heiland_text->languages()->attach($german);  
            
          $ros_piece->epoque()->associate($moderne);
          $ros_piece->instrumentation()->associate($satb);
          $ros_piece->text()->associate($ros_text);
          $ros_piece->difficulty()->associate($mschwer);          
          $ros_text->languages()->attach($german);

          $ros_text->lyricist()->associate($spee);
          
          $distler_image->person()->associate($distler);
          $reger_image->person()->associate($reger);
          $brahms_image->person()->associate($brahms);
          $spee_image->person()->associate($spee);
          $schroeter_image->person()->associate($schroeter);

          // save everything

          $satb->save();
          $ssatb->save();

          $distler_image->save();
          $reger_image->save();
          $brahms_image->save();
          $spee_image->save();
          $schroeter_image->save();
          
          $schiff_piece->save();
          $himmel_piece->save();
          $heiland_piece->save();
          $ros_piece->save();          
          $in_dulci_piece->save();
          
          $in_dulci_text->save();
          $schiff_text->save();
          $ros_text->save();
    }
}
