<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);

        return view('review.create', compact('product'));
    }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'text' => 'required|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

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
// namespace App\Http\Controllers;

// use App\Models\Product;
// use App\Models\Review;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class ReviewController extends Controller
// {
//     public function create(Product $product)
//     {
//         return view('reviews.create', compact('product'));
//     }

//     public function store(Request $request, Product $product)
//     {
//         $request->validate([
//             'text' => 'required|string|max:1000',
//             'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
//         ]);

//         $review = new Review;
//         $review->text = $request->text;
//         $review->user_id = Auth::id();
//         $review->product_id = $product->id;
//         $review->save();

//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 $path = $image->store('reviews');
//                 $review->images()->create(['url' => $path]);
//             }
//         }

//         return redirect()->route('products.show', $product)->with('success', 'Отзыв успешно добавлен');
//     }
// }

// public function store(Request $request)
// {
//     $product_id = $request->input('product_id');
//     $review_text = $request->input('review_text');
//     $images = $request->file('images');
    
//     $review = new Review();
//     $review->product_id = $product_id;
//     $review->review_text = $review_text;
//     $review->save();
    
//     if (!empty($images)) {
//         foreach ($images as $image) {
//             $url = $image->store('public/review_images');
//             $image = new Image();
//             $image->review_id = $review->id;
//             $image->url = $url;
//             $image->save();
//         }
//     }
    
//     return redirect()->back()->with('success', 'Review created successfully!');
// }
