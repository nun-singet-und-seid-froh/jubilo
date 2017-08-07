<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Piece;
use App\Models\Person;


class BoardController extends Controller
{
    public function index()  {
        return view('board.index');
    }
}
