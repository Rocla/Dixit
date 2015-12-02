<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

class ReadMeController extends Controller
{
    public function getIndex()
    {
        return view('readme');
    }
}
