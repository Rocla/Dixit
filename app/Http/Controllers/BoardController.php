<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

class BoardController extends Controller
{
    public function getIndex()
    {  
        return view('board');  
    }
}
