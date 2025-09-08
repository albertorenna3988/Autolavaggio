<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function index()
    {
        // Per ora passiamo un URL placeholder (iframe o video)
        // Quando ricevi le API potrai cambiare questo valore dinamicamente
        $liveStreamUrl = "https://www.youtube.com/watch?v=DbXvYNSase0"; // esempio: un video youtube embed

        return view('live', compact('liveStreamUrl'));
    }
}
