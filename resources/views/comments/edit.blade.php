@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Include form fields pre-filled with post details for editing -->

        <button type="submit">Update Post</button>
    </form>
@endsection
