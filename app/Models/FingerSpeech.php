<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FingerSpeech extends Model
{
    protected $fillable = [
        'huruf',
        'gambar',
        'deskripsi',
        'sort_order'
    ];

    protected static function booted()
    {
        static::saving(function ($fingerSpeech) {
            if ($fingerSpeech->isDirty('sort_order')) {
                $existingFingerSpeech = static::where('sort_order', $fingerSpeech->sort_order)
                    ->where('id', '!=', $fingerSpeech->id)
                    ->first();

                if ($existingFingerSpeech) {
                    static::where('sort_order', '>=', $fingerSpeech->sort_order)
                        ->where('id', '!=', $fingerSpeech->id)
                        ->increment('sort_order');
                }
            }
        });
    }
}