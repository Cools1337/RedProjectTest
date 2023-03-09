<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
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
            ->get();
        
        $categories = Category::query()
            ->where('name', 'ilike', "%{$query}%")
            ->get();
        
        $results = collect([]);
        $results = $results->merge($products);
        $results = $results->merge($categories);
        $results = $results->sortBy('name')->values()->all();
        
        return view('search.index', [
            'query' => $query,
            'results' => $results,
        ]);
    }
    
}
