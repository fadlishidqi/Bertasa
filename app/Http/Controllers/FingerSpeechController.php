<?php

namespace App\Http\Controllers;

use App\Models\FingerSpeech;
use Illuminate\Http\Request;

class FingerSpeechController extends Controller
{
    public function index()
{
    $bahasaIsyarat = FingerSpeech::orderBy('sort_order')->get();
    return view('finger-speech.index', compact('bahasaIsyarat'));
}
}
