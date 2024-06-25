<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Response;

class UserService
{
    public function usersJson() {
        $users = User::latest('created_at')->get();

        if(count($users) > 0) {
            return response()->json([
                'status' => '200',
                'users' => $users
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'users' => null
            ]);
        }
    }
    public function usersDetailsJson($id) {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], 401);
        }


        $user = User::where('id', $id)
                    ->first();

        if ($user) {
            return response()->json([
                'status' => '200',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'user' => null
            ]);
        }

    }
    public function userName($user_id)
    {
        $user = User::find($user_id);
        return $user->name;
    }

    public function userNamesIds()
    {
        $users = User::pluck('name', 'id');

        return Response::json([
            'status' => '200',
            'users' => $users
        ]);
    }
}
