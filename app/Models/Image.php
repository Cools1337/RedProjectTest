<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'review_id',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
