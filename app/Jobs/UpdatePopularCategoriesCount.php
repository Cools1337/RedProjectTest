<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class UpdatePopularCategoriesCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 
         Category::query()
         ->leftJoin('products_categories', 'categories.id', '=', 'products_categories.category_id')
         ->leftJoin('products', 'products_categories.product_id', '=', 'products.id')
         ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
         ->select('categories.id', DB::raw('COUNT(DISTINCT reviews.id) as reviews_count'))
         ->groupBy('categories.id')
         ->get()
         ->each(function($category) {
             Category::updateOrCreate(
                 ['id' => $category->id],
                 ['reviews_count' => $category->reviews_count]
             );
         });

        
        // $reviewsCountByCategory = DB::table('categories')
        // ->select('categories.id', DB::raw('COUNT(reviews.id) as reviews_count'))
        // ->leftJoin('products_categories', 'categories.id', '=', 'products_categories.category_id')
        // ->leftJoin('products', 'products_categories.product_id', '=', 'products.id')
        // ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
        // ->groupBy('categories.id')
        // ->get();
            
        // foreach ($reviewsCountByCategory as $reviewsCount) {
        //     Category::where('id', $reviewsCount->id)
        //         ->update(['reviews_count' => $reviewsCount->reviews_count]);
        // }
    
    

        // $categories = Category::all();

        //  foreach ($categories as $category) {
        //    $reviewsCount = Review::whereHas('product', function ($query) use ($category) {
        //           $query->whereHas('categories', function ($query) use ($category) {
        //               $query->where('categories.id', $category->id);
        //           });
        //       })->count();
        //       Category::updateOrCreate(
        //           ['id' => $category->id],
        //           ['reviews_count' => $reviewsCount]
        //       );
        //  }
    }
}
