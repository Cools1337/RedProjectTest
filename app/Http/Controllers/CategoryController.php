<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->paginate(10);
        return view('categories.show', compact('category', 'products'));
    }

    public function popularShow(Category $category)
    {
        $popularCategories = $category->orderByDesc('reviews_count')->take(5)->get();
        return view('categories.popularCategories', compact('popularCategories'));
    }
}
