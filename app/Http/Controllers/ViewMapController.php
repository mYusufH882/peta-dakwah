<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewMapController extends Controller
{
    public function index()
    {
        return view('view-map');
    }
}
