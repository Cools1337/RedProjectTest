<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Image;


class ReviewController extends Controller
{
    public function store(Request $request)
{
    $product_id = $request->input('product_id');
    $review_text = $request->input('review_text');
    $images = $request->file('images');
    
    $review = new Review();
    $review->product_id = $product_id;
    $review->review_text = $review_text;
    $review->save();
    
    if (!empty($images)) {
        foreach ($images as $image) {
            $url = $image->store('public/review_images');
            $image = new Image();
            $image->review_id = $review->id;
            $image->url = $url;
            $image->save();
        }
    }
    
    return redirect()->back()->with('success', 'Review created successfully!');
}
}
