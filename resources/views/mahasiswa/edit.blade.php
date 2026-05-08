<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $mahasiswa->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $mahasiswa->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nim" :value="__('nim')" />
                            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim', $mahasiswa->nim)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="angkatan" :value="__('angkatan')" />
                            <x-text-input id="angkatan" class="block mt-1 w-full" type="number" name="angkatan" :value="old('angkatan', $mahasiswa->angkatan)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="prodi" :value="__('prodi')" />
                            <select id="prodi" name="prodi" class="border-gray-300 block mt-1 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option selected disabled>Select Prodi</option>
                                @foreach ($prodis as $p )
                                    <option value="{{ $p->id }}" {{ old('prodi', $mahasiswa->prodi_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                         <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
