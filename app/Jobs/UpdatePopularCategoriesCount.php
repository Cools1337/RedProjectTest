<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;
use App\Models\PopularCategory;
use App\Models\Review;
use DB;

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
        $categories = Category::all();

        foreach ($categories as $category) {
            $reviewsCount = Review::whereHas('product', function ($query) use ($category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                });
            })->count();
    
            PopularCategory::updateOrCreate(
                ['category_id' => $category->id],
                ['reviews_count' => $reviewsCount]
            );
        }
    }
}
