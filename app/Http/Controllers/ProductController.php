<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }

    public function toggleFavorites(Request $request)
    {
        $productId = $request->input('product_id');
        /** @var App/Models/User */
        $user = Auth::user();
        $user->favorites()->toggle($productId);

        return response()->json();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::query()
            ->where('title', 'ilike', "%{$query}%")
            ->get()
            ->pluck('title')
            ->toArray();

        $categories = Category::query()
            ->where('name', 'ilike', "%{$query}%")
            ->get()
            ->pluck('name')
            ->toArray();

        $results = array_merge($products, $categories);
        sort($results);
        return view('search.index', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
