<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8 p-8 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Add a Comment') }}</h2>

        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Comment') }}</label>
                <textarea name="content" id="content" rows="5" class="mt-1 p-2 w-full border rounded-md"></textarea>
            </div>

            <input type="hidden" name="post_id" value="{{ $postId }}">

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">{{ __('Add Comment') }}</button>
        </form>
    </div>
</x-app-layout>
