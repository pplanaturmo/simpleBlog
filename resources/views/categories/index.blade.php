
<x-app-layout>
    @if(session('info'))
    <div class="alert alert-success text-center bg-lime-500 w-3/5 mx-auto">
        <strong>{{ __(session('info')) }}</strong>
    </div>
    @endif
    <div class="flex">
        <div class="w-1/4 p-4">
            <div class="mt-4">
                @can('manage categories') <!-- Permisos-->
                <div class=" mt-5 mb-5">
                    <a href="{{ route('categories.create') }}"
                        class=" border border-black w-full bg-green-500 text-white p-2 rounded">
                        {{ __('Create Category') }}
                    </a>
                </div>
                @endcan
                @foreach ($categories as $category)
                    <div class="mb-2 flex items-center">
                        <form class="flex-grow"action="{{ route('categories.index', ['categoryId' => $category->id]) }}"
                            method="get">
                            @csrf
                            <button type="submit"
                                class=" border border-black w-full text-left p-2 rounded {{ $categoryId == $category->id ? 'bg-blue-500 text-white' : 'bg-white text-black' }}">
                                {{ $category->name }}
                            </button>

                        </form>
                        @can('manage categories') <!-- Permisos-->

                        <a href="{{ route('categories.edit', ['slug' => $category->slug]) }}"
                            class="border border-black ml-2 bg-yellow-500 text-white p-1 rounded">{{ __('Edit') }}</a>

                        <form action="{{ route('categories.destroy', ['slug' => $category->slug]) }}" method="post"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class=" border border-black ml-2 bg-red-500 text-white p-1 rounded">{{ __('Delete') }}</button>
                        </form>
                        @endcan



                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-3/4 p-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-10">
                <div class="p-6 text-gray-900">
                    <h2>{{ __('Posts') }}</h2>
                    <div class="mt-8">
                        @foreach ($posts as $post)
                            <article style="width:300px" class="text-left p-2">
                                <h3 class="py-4 text-xl">{{ $post->title }}</h3>
                                @if ($post->hasMedia('postImages'))
                                    <div
                                        class="max-w-4xl w-3/4 p-3 text-left mx-auto border rounded shadow-sm bg-gray-50">
                                        <img src="{{ $post->getFirstMediaUrl('postImages') }}"
                                            alt="{{ $post->title }}" class="max-w-full h-auto">
                                    </div>
                                @endif
                                <p><a class="font-bold text-blue-600 no-underline hover:underline"
                                        href="{{ route('posts.show', $post->slug) }}">{{ __('Read more') }}</a></p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>
