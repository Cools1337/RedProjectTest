<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\CategoriesHelper;
use App\Models\Product;
use App\Models\Category;
use Psy\Readline\Hoa\Console;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                $newProduct = Product::create([
                    'title' => "{$category->name} товар {$i}",
                    'description' => "Описание {$category->name} товара {$i}",
                    'price' => rand(10, 1000),
                ]);
                $newProduct->categories()->attach($categories->find($category->id));
            }
        }
    }
}
