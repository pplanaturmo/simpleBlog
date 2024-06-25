<x-app-layout>

<div class="py-12 flex items-center justify-center w-3/5 mx-auto">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
            <div class="p-6 text-gray-900">
                <h2>{{ __('Users') }} {{ __('JSON') }}</h2>
            </div>

            <div class="p-6 text-gray-900">

                <pre>{{ json_encode($users, JSON_PRETTY_PRINT) }}</pre>

            </div>

        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
            <div class="p-6 text-gray-900">
                <h2>{{ __('Posts') }}  {{ __('JSON') }}</h2>
            </div>
            <div class="p-6 text-gray-900">
                <pre>{{ json_encode($posts, JSON_PRETTY_PRINT) }}</pre>

            </div>
        </div>

    </div>
</div>

</x-app-layout>
