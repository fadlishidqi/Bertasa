<?php

namespace App\Http\Controllers;

use App\Models\FingerSpeech;
use Illuminate\Http\Request;

class FingerSpeechController extends Controller
{
    public function index()
    {
        $bahasaIsyarat = FingerSpeech::all();
        return view('finger-speech.index', compact('bahasaIsyarat'));
    }
}
