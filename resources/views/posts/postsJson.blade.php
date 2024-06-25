@extends('layouts.app')

@section('content')
    <h2>{{ __('Posts') }}</h2>

    <div id="posts-container">

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            //coger datos
            $.ajax({
                url: '/posts-json',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // rellenar html
                    var postsContainer = $('#posts-container');

                    response.posts.forEach(function(post) {
                        var postHtml = '<div><h2>' + post.title + '</h2><p>' + post.content + '</p></div>';
                        postsContainer.append(postHtml);
                    });
                },
                error: function(error) {
                    console.error('Error fetching posts:', error);
                }
            });
        });
    </script>
@endsection
{{--
@section('content')
    <h2>{{ __('Posts') }}</h2>

    <div id="posts-container">

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch data
            var postsJson = {!! $postsJson !!};
            var posts = JSON.parse(postsJson);

            // Populate HTML
            var postsContainer = $('#posts-container');
            posts.forEach(function(post) {
                var postHtml = '<div><h2>' + post.title + '</h2><p>' + post.content + '</p></div>';
                postsContainer.append(postHtml);
            });
        });
    </script>
@endsection --}}
