<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(collect(json_decode(file_get_contents(base_path('categories.json'))))['categories']);

        $parentCategories = collect($categories->where('parent_aliases', null)->all());


        $parentCategories->each(function ($parentCateg) {
            Category::create([
                'alias' => $parentCateg->alias,
                'title' => $parentCateg->title,
                'created_at' => now(),

            ]);
        });

        $categories->chunk(100)->each(function ($categories) {
            $categories->map(function ($category) {
                if ($category->parent_aliases) {
                    $parent = Category::where('alias', $category->parent_aliases[0])->first();
                    if ($parent) {
                        return Category::create([
                            'alias' => $category->alias,
                            'title' => $category->title,
                            'parent_id' => $parent->id,
                        ]);
                    }
                }
            });
        });
    }
}
