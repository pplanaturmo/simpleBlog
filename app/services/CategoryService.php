<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{


    public function categoriesJson() {
        $categories = Category::latest('created_at')->get();

        if(count($categories) > 0) {
            return response()->json([
                'status' => '200',
                'categories' => $categories
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'categories' => null
            ]);
        }
    }
    public function categoryDetailsJson($slug) {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }


        $category = Category::where('slug', $slug)
                    ->first();

        if ($category) {
            return response()->json([
                'status' => '200',
                'post' => $category
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'post' => null
            ]);
        }

    }
}
