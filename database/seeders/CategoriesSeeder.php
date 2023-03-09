<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\CategoriesHelper;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Компьютеры',
            'Телефоны',
            'Телевизоры',
            'Фотоаппараты',
            'Аудиотехника',
            'Кухонные приборы',
            'Стиральные машины',
            'Холодильники',
            'Мебель',
            'Одежда',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
