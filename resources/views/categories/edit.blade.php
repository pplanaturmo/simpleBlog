<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8 p-8 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Edit Category') }}</h2>

        <form action="{{ route('categories.update', ['slug' => $category->slug]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md" value="{{ old('name', $category->name) }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">{{ __('Update Category') }}</button>
        </form>
    </div>
</x-app-layout>
