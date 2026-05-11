
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <div>
                       <img src="/storage/images/avatars/{{\Illuminate\Support\Facades\Auth::user()->avatar}}" />
                    </div>

                    <form method="POST" action="{{ route('profile.image.update') }}" enctype="multipart/form-data">



                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700" for="profile_image">
                                Upload Profile Image
                            </label>
                            <input
                                type="file"
                                name="profile_image"
                                id="profile_image"
                                accept="image/*"
                                class="mt-2 block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-300"
                                required
                            >
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG, or JPEG (Max 2MB)
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
