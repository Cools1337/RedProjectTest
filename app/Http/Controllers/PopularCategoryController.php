<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularCategory;

class PopularCategoryController extends Controller
{
    public function index()
    {
        $popularCategories = PopularCategory::with('category')->orderByDesc('reviews_count')->take(5)->get();

        return view('popularCategories', compact('popularCategories'));
    }
}
