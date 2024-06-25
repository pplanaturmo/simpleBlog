<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{

    //funcion para mostrar la página para invitados, usando un json
    public function guest()
    {
        $user = Auth::user();
        if ($user) {
            return redirect("/blog");
        } else {
            $postService = new PostService;
            $postsResponse = $postService->publishedPosts();
            $posts = json_decode($postsResponse->getContent(), true);
            $postsMedia = $postsResponse;
            return view('guest.index', compact('posts', 'postsMedia'));
        }
    }

    //funcion para mostrar posts usando json
    public function index()
    {
        //CON JSON
        $postService = new PostService;
        $postsResponse = $postService->publishedPosts();
        $posts = json_decode($postsResponse->getContent(), true);
        return view('posts.index', compact('posts'));
    }

    //funcion para mostrar la página inicial del blog, con eloquent
    public function postList()
    {
        //usando eloquent
        $posts = Post::latest('updated_at')->get();
        return view('blog', compact('posts'));
    }

    //funcion para mostrar post individual
    public function show($slug)
    {

        $post = Post::where('slug', $slug)->first();
        $user = User::where('id', $post->user_id)->first();
        return view('posts.post', compact('post', 'user'));
    }

    //funcion para crear post
    public function create()
    {

        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }


//funcion para almacenar post creado
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $post = new Post($validatedData);
        $post->user_id = auth()->user()->id;
        $post->category()->associate($request->input('category_id'))->save();

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('postImages');
            $post->addMedia($request->file('image'))->toMediaCollection('postImages');
        }

        // Cambio de slug al nuevo slug
        $post->slug = Str::slug($post->title);

        return redirect()->route('blog', $post)->with('info', 'Post created successfully!');
    }


    //funcion para editar post
    public function edit($slug)
    {

        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

//funcion para actualizar el post editado en la base de datos
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::where('slug', $slug)->firstOrFail();


        if ($validatedData['title'] !== $post->title) {
            $post->slug = Str::slug($validatedData['title']);
        }

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
        ]);

        // cambio de imagen
        if ($request->hasFile('image')) {

            $post->clearMediaCollection('postImages');
            $post->addMedia($request->file('image'))->toMediaCollection('postImages');
        }

        return redirect()->route('blog')->with('info', 'Post updated successfully');
    }


    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $post->delete();

        $posts = Post::latest('updated_at')->get();

        return redirect()->route('blog')->with('info', 'Post deleted successfully!');
    }

    public function attachImage(Request $request, Post $post)
    {
        // Check if the user has permission to attach an image to the post
        $this->authorize('attachImage', $post);

        // Validate the request data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Attach image using Spatie media library
        $post->addMedia($request->file('image'))->toMediaCollection('postImages');

        return redirect()->route('posts.show', $post)->with('info', 'Image attached successfully!');
    }

    public function detachImage(Post $post, Media $media)
    {
        // Check if the user has permission to detach an image from the post
        $this->authorize('detachImage', $post);

        // Detach image using Spatie media library
        $media->delete();

        return redirect()->route('posts.show', $post)->with('info', 'Image detached successfully!');
    }
}
