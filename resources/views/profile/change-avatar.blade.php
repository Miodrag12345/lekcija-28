<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Avatar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('status') === 'avatar-updated')
                        <p class="text-green-600 mb-4">Avatar uspešno promenjen!</p>
                    @endif

                    <form method="POST" action="{{ route('profile.changeAvatar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="profile_image" class="block text-sm font-medium text-gray-700">
                                Izaberi sliku
                            </label>
                            <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full" />
                            @error('profile_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Sačuvaj avatar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
