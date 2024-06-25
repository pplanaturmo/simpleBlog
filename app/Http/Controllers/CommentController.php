<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    /**
     * Mostrar formulario para crear comentario
     */
    public function create($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('comments.create', ['postId' => $post->id]);
    }

    /**
     * Almacenar comentario creado
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment($validatedData);
        $comment->name = auth()->user()->name;
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->save();
        $post = Post::find($request->post_id);
        return Redirect::route('posts.show', ['slug' => $post->slug])->with('success', 'Comment added successfully.');
 }

 //Funcion para destruir comentario
    public function destroy($slug,$commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return Redirect::route('posts.show', ['slug' => $slug])->with('success', 'Comment deleted successfully.');

 }

}
