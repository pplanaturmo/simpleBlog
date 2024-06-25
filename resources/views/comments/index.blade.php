@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @foreach($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <!-- Add links for view, edit, and delete -->
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
