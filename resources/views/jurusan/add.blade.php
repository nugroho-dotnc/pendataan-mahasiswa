<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6">
                 <form action="{{ route('jurusan.store') }}" method="POST" class="flex flex-col gap-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="is_active" :value="__('is_active')"/>
                            <input id="is_active" type="checkbox" class="w-6 h-6 rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} />
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>
                        <x-primary-button type="submit" class="w-full max-w-24 ms-auto">
                            {{ __("Submit") }}
                        </x-primary-button>
                    </form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
