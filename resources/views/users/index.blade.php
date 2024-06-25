<x-app-layout>

    @if (session('info'))
        <div class="alert alert-success text-center bg-lime-500 w-3/5 mx-auto">
            <strong>{{ __(session('info')) }}</strong>
        </div>
    @endif

    <div class="py-12 flex items-center justify-center w-3/5 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900">
                    <h2>{{ __('User Management') }}</h2>


                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('User') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Roles') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Change Role') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <form action="{{ route('users.changeRole', $user->id) }}" method="post" class="inline">
                                            @csrf
                                            <label for="role" class="sr-only">{{ __('Select Role') }}</label>
                                            <select name="role" id="role"
                                                class="block py-1 px-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                @foreach ($roles as $roleId => $roleName)
                                                    <option value="{{ $roleId }}">{{ $roleName }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-blue-500 text-white p-1 rounded-md">{{ __('Change Role') }}</button>
                                        </form>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="bg-red-500 text-white p-1 rounded-md ml-2"
                                                onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
