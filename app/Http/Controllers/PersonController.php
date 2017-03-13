<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Person;

class PersonController extends Controller
{
  public function add()
  {
      return view('person.add.1', ['type'=>'composer']);
  }
  
  public function store(Request $request)
  {
      $rules = [
          'lastName' => 'required|unique_with:persons,firstName',
          'birthYear' => 'numeric',
          'deathYear' => 'required|numeric|max:1947',
      ];
      
      $messages = [
          'lastName.required' =>'Bitte gib den Nachnamen an.',
          'birthYear.numeric' => 'Das Geburtsjahr muss eine Zahl sein.',
          'lastName.unique_with' => 'Diese Person ist bereits vorhanden!',
          'deathYear.required' =>'Bitte gib das Sterbejahr an.',
          'deathYear.numeric' => 'Das Sterbejahr muss eine Zahl sein.',
          'deathYear.max' => 'Wir führen nur Komponist*innen, die vor 1946 gestorben sind, da die Werke sonst nicht gemeinfrei sind.',
          'deathYear.min' => 'Das Sterbejahr kann nicht vor dem Geburtsjahr liegen.'
      ];
      
      $validator = Validator::make($request->all(), $rules, $messages);
      
      if ( $validator->fails() )
      {
          return redirect('composer/add/1')
            ->withErrors($validator)
            ->withInput();
      } 
  
      $composer = new Person;
      if ( $request->firstName )
      {
        $composer['firstName'] = $request->firstName;
      }
      
      if ( $request->interName )
      {
        $composer['interName'] = $request->interName;
      }
      
      $composer['lastName'] = $request->lastName;
 
      if ( $request->birthYear )
      {
        $composer['birthYear'] = $request->birthYear;
      }

      if ( $request->deathYear )
      {
        $composer['deathYear'] = $request->deathYear;
      }
      
      $composer->save();
  }
}
