<x-app-layout>
    @if(session('info'))
    <div class="alert alert-success text-center bg-lime-500 w-3/5 mx-auto">
        <strong>{{ __(session('info')) }}</strong>
    </div>
@endif

    <h2 class="max-w-4xl w-3/4 p-3 text-left mx-auto border rounded shadow-sm bg-gray-50 text-2xl font-bold mt-11">
        {{ $post->title }}
    </h2>

    @if ($post->hasMedia('postImages'))
        <div class="max-w-4xl w-3/4 p-3 text-left mx-auto border rounded shadow-sm bg-gray-50">
            <img src="{{ $post->getFirstMediaUrl('postImages') }}" alt="{{ $post->title }}" class="max-w-full h-auto">
        </div>
    @endif
    <article class="w-full py-8">
        <div class="flex justify-center">
            <div class="max-w-4xl w-3/4 p-3 text-left mx-auto border rounded shadow-sm bg-gray-50">
                {{ $post->content }}
            </div>
        </div>
        <div class="max-w-4xl w-3/4 p-3 mx-auto rounded flex justify-between">
            <div>
                {{ __('Posted by: ') }}{{ $post->user->name }}
            </div>
            <div>
                {{ __('Last updated at: ') }}{{ $post->updated_at }}
            </div>
        </div>

    </article>

    <div class="max-w-4xl w-3/4 p-3 mx-auto rounded flex justify-between">
        <div>
            @can('create comments')
                <!-- Permisos-->
                <form action="{{ route('comments.create', ['slug' => $post->slug]) }}" method="GET">
                    <button type="submit"
                        class="mr-2 bg-blue-500 text-white p-2 rounded-md">{{ __('Add Comment') }}</button>
                </form>
            @endcan
        </div>
        <div class="flex">
            @can('edit any post')
                <!-- Permisos-->
                <form action="{{ route('posts.edit', ['slug' => $post->slug]) }}" method="GET">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-md">{{ __('Edit Post') }}</button>
                </form>
                <form action="{{ route('posts.destroy', ['slug' => $post->slug]) }}" method="POST" class="ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white p-2 rounded-md">{{ __('Delete Post') }}</button>

                </form>
            @endcan
        </div>
    </div>
    <div class="max-w-4xl flex-row justify-start p-3 text-left mx-auto border rounded shadow-sm bg-gray-50">
        <h3 class="py-4 text-2xl">{{ __('Comments') }}</h3>
        <div>
            @foreach ($post->comments as $comment)
                <div class="w-full bg-white p-2 my-2 border">
                    <div class="flex justify-between mb-4 text-sm text-gray-500">
                        <div>
                            {{ __('Created by: ') }}{{ $comment->name }}
                        </div>
                        <div>
                            {{ __('Created at: ') }}
                            {{ $comment->created_at->format('j F, Y') }}
                        </div>
                    </div>
                    <div class="text-lg">{{ $comment->content }}</div>
                </div>
                @can('delete any comment')
                    <form action="{{ route('comments.destroy', ['commentId' => $comment->id,'slug' => $post->slug ]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-md">
                            {{ __('Delete Comment') }}
                        </button>
                    </form>
                @endcan

        @endforeach
    </div>
    </div>
    </div>
    <section class="w-full py-8">

    </section>
</x-app-layout>
