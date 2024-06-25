<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{


    public function commentsJson() {
        $comments = Comment::latest('created_at')->get();

        if(count($comments) > 0) {
            return response()->json([
                'status' => '200',
                'comments' => $comments
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'comments' => null
            ]);
        }
    }
    public function commentsDetailsJson($id) {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }


        $comment = Comment::where('id', $id)
                    ->first();

        if ($comment) {
            return response()->json([
                'status' => '200',
                'post' => $comment
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'post' => null
            ]);
        }

    }
}
