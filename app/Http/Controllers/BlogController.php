<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;


class BlogController extends Controller
{

    public function guest() {

        $postService = new PostService; //crear clase
        $postsResponse = $postService->publishedPosts(); //ejecuta funcion json
        $posts = json_decode($postsResponse->getContent(), true); //asigna los json decodificados a variable

        return view('guest.index', compact('posts'));
    }









public function allJsons(Request $request)
{
    $userService = new UserService;
    $usersResponse = $userService->usersJson();
    $users = json_decode($usersResponse->getContent(), true);
    $postService = new PostService;
    $postsResponse = $postService->publishedPosts();
    $posts = json_decode($postsResponse->getContent(), true);

    return view('json', compact('users', 'posts'));
}

}
