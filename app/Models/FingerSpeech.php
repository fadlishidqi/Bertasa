<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FingerSpeech extends Model
{
    protected $fillable = [
        'huruf',
        'gambar',
        'deskripsi'
    ];
}
