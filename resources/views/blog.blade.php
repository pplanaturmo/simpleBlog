<x-app-layout>

    @if (session('info'))
        <div class="alert alert-success text-center bg-lime-500 w-3/5 mx-auto">
            <strong>{{ __(session('info')) }}</strong>
        </div>
    @endif

    <div class="py-12 flex items-center justify-center w-3/5 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full flex-col justify-center">
                <div class="p-6 text-gray-900 text-center">
                    <h2>{{ __('Latest Posts') }}</h2>
                </div>

                @foreach ($posts as $post)
                    <article style="width:300px" class="text-left p-2">

                        <h3 class="py-4 text-xl">{{ $post->title }}</h3>
                        @if ($post->hasMedia('postImages'))
                            <div class="max-w-4xl w-3/4 p-3 text-left mx-auto border rounded shadow-sm bg-gray-50">
                                <img src="{{ $post->getFirstMediaUrl('postImages') }}" alt="{{ $post->title }}"
                                    class="max-w-full h-auto">
                            </div>
                        @endif
                        <p><a class="font-bold text-blue-600 no-underline hover:underline"
                                href="{{ route('posts.show', $post->slug) }}">{{ __('Read more') }}</a></p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
