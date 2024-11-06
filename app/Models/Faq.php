<?php

// app/Models/Faq.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($faq) {
            if ($faq->isDirty('sort_order')) {
                $existingFaq = static::where('sort_order', $faq->sort_order)
                    ->where('id', '!=', $faq->id)
                    ->first();

                if ($existingFaq) {
                    static::where('sort_order', '>=', $faq->sort_order)
                        ->where('id', '!=', $faq->id)
                        ->increment('sort_order');
                }
            }
        });
    }
}
