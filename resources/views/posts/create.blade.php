<x-app-layout>


<div class="max-w-4xl mx-auto mt-8 p-8 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">{{ __('Create a New Post') }}</h2>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
            <textarea name="content" id="content" rows="5" class="mt-1 p-2 w-full border rounded-md" required></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
            <input type="file" name="image" id="image" class="mt-1">
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
            <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-md">

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">{{ __('Create Post') }}</button>
    </form>
</div>
</x-app-layout>
