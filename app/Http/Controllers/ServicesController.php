<?php

namespace App\Http\Controllers;

class ServicesController extends Controller
{
    public function index()
    {
        return view('servizi'); // usa il nome corretto del file nella cartella /views
    }
}
