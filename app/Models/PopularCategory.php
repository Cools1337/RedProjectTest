<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'reviews_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
