<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\v1\CompanyResource;
use App\Models\Categories;
use App\Queries\v1\FetchCompanies;
use Illuminate\Http\Request;

final class TestController extends Controller
{

    public function __invoke(Request $request)
    {
        /*{
      "alias": "specialbikes",
      "title": "Special Bikes",
      "parent_aliases": [
        "bicycles"
      ],
      "country_whitelist": [
        "DK",
        "PT"
      ],
      "country_blacklist": []
    },
    {
      "alias": "specialed",
      "title": "Special Education",
      "parent_aliases": [
        "education"
      ],
      "country_whitelist": [],
      "country_blacklist": [
        "FI"
      ]
    },*/
        // load categories from categories json file

        $categories = collect(collect(json_decode(file_get_contents(base_path('categories.json'))))['categories']);

        $parentCategories = collect($categories->where('parent_aliases', null)->all());


        $parentCategories->each(function ($parentCateg) {
            Categories::create([
                'alias' => $parentCateg->alias,
                'title' => $parentCateg->title,

            ]);
        });

        $categories->chunk(100)->each(function ($categories) {
            $categories->map(function ($category) {
                if ($category->parent_aliases) {
                    $parent = Categories::where('alias', $category->parent_aliases[0])->first();
                    if ($parent) {
                        return Categories::create([
                            'alias' => $category->alias,
                            'title' => $category->title,
                            'parent_id' => $parent->id,
                        ]);
                    }
                }
                
            });
        });
return response()->json(['message' => 'Categories created successfully'], 200);

    }
}
