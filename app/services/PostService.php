<?php

namespace App\Services;

use App\Models\Post;

class PostService
{


    public function publishedPosts() {
        $posts = Post::latest('created_at')->get();

        if(count($posts) > 0) {
            return response()->json([
                'status' => '200',
                'posts' => $posts
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'posts' => null
            ]);
        }
    }

    public function ownPosts() {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }

        $userId = $user->id;

        $posts = Post::where('user_id', $userId)
                     ->where('is_published', true)
                     ->orderBy('created_at', 'desc')
                     ->get();

        if(count($posts) > 0) {
            return response()->json([
                'status' => '200',
                'posts' => $posts
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'posts' => null
            ]);
        }
    }

    public function postDetails($slug) {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }


        $post = Post::where('slug', $slug)
                    ->where('is_published', true)
                    ->first();

        if ($post) {
            return response()->json([
                'status' => '200',
                'post' => $post
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'post' => null
            ]);
        }

    }
    public function showOwnPost($slug) {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }

        $userId = $user->id;

        $post = Post::where('user_id', $userId)
                    ->where('slug', $slug)
                    ->where('is_published', true)
                    ->first();

        if ($post) {
            return response()->json([
                'status' => '200',
                'post' => $post
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'post' => null
            ]);
        }
    }
}
