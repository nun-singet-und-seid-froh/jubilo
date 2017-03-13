<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Image;

class ImageController extends Controller
{    
    public function prepare(Request $request) {
        $fileName = str_random(40);
        $request->file('composer-image-raw')->storeAs('public/temp', $fileName);
        $response = [
            'path' => $fileName,
        ];
        return $response;
    }
/*    
    public function store(Request $request) {
      $rules = [
        'image' => 'required|image',
        'source' => 'required',
        'description' => 'required',
        'license' => 'required',
      ];
      
      $messages = [
        'image.required' => 'Bitte wähle eine Bilddatei aus.',
        'image.image' => 'Das Bild muss in einem der Formate .jpg, .png, .bmp oder .gif gespeichert sein.',
        'source.required' =>'Bitte gib eine Bildquelle an.',
        'description.required' =>'Bitte gib eine kurze Bildbeschreibung an.',        
        'source.required' =>'Bitte gib eine Lizenz an, unter der das Bild veröffentlicht ist. Falls die Urheberrechte erloschen sind, schreib "gemeinfrei".',        
      ];
      
      $validator = Validator::make($request->all(), $rules, $messages);


      if ($validator->fails()) {
        return redirect('image/add')
          ->withErrors($validator)
          ->withInput();
        }      
      
      $image = new Image;
        $image['fileName'] = $request->image->path();
        $image['description'] = $request->description;
        $image['license'] = $request->license;
        $image['source'] = $request->source;
      $image->save();
              
      return view('composer.add.2', ['image_id'=>$image['id'] ]);
    }
*/    
}
