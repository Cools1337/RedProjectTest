<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);

        return view('review.create', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
            'images' => 'nullable|max:3',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $review = new Review();
        $review->text = $request->input('text');
        $review->user_id = Auth::id();
        $review->product_id = $productId;
        $review->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $path = $image->store('public/review_images');
                $imageUrl = Storage::url($path);

                $img = new Image();
                $img->url = $imageUrl;
                $img->review_id = $review->id;
                $img->save();
            }
        }

        return redirect('/products')->with('success', 'Отзыв отправлен');
    }
}