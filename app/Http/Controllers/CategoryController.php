<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Jobs\UpdatePopularCategoriesCount;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->paginate(10);
        return view('categories.show', compact('category', 'products'));
    }
    public function popularShow(Category $category)
    {
        UpdatePopularCategoriesCount::dispatch();
        $popularCategories = $category->orderByDesc('reviews_count')->take(5)->get();

        return view('categories.popularCategories', compact('popularCategories'));
    }
}
