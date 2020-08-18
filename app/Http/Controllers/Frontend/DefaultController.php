<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class DefaultController extends Controller
{

    public function index()
    {
        return view('layouts.frontend');
    }

}
