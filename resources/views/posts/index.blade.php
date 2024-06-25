{{-- @extends('layouts.app') --}}

{{-- @section('content')
    <h2>{{ _('Posts') }}</h2>

    @foreach ($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <!-- Add links for view, edit, and delete -->
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection --}}

@extends('layouts.home')

@section('content')
    @guest
        <section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
            <h2 class="py-4 text-3xl">About me</h2>
            <div class="flex text-justify justify-center">
                <div class="max-w-5xl px-2">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate necessitatibus ullam commodi perferendis
                    accusamus sint error sequi, dolorem nam, vel praesentium dignissimos nostrum quod fuga corporis asperiores
                    laudantium, possimus veniam!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur iure cumque qui impedit quod earum
                    dolores nisi nemo totam vero natus aperiam, libero consequuntur nesciunt atque officia exercitationem rerum.
                    Veritatis!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas in hic ratione recusandae nostrum, saepe
                    aliquam alias ipsum? Asperiores rerum numquam officia harum atque, impedit perspiciatis facilis nobis
                    tempora est!
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="flex justify-center">
                <div class="max-w-6xl text-center">
                    <h2 class="py-4 text-3xl border-solid border-gray-300 border-b-2">Lasts posts</h2>
                    <div class="flex flex-wrap justify-between">

                        @dd($posts)
                        @foreach ($posts['posts'] as $post)
                            <article style="width:300px" class="text-left p-2">
                                @if(auth()->check())
                                <h3 class="py-4 text-xl">{{ $post['title'] }}</h3>
                                <p><a class="font-bold text-blue-600 no-underline hover:underline"
                                    href="{{ route('posts.detail', $post["slug"]) }}">{{ __('Read more') }}</a></p>
                                @else
                                <h3 class="py-4 text-xl">{{ $post['title'] }}</h3>
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endguest
@endsection
