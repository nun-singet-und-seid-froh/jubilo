<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BoardController extends Controller
{
    public function index()  {
        if ( Auth::user()->hasRole('admin') or Auth::user()->hasRole('editor') ) {
            return view('board.index');
        }
        else {
            return view('board.unconfirmed');
        }
    }
}
