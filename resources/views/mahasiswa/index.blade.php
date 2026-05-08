<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    {{ __("Table Mahasiswa!") }}
                    <form action="{{ route('mahasiswa.create') }}">
                        @csrf
                        <x-primary-button type="submit">
                            {{ __("Tambah") }}
                        </x-primary-button>
                    </form>
                </div>
                <div class="p-6">
                    <table class="table-auto text-white w-full text-center border-collapse border border-white">
                        <thead>
                            <tr>
                                <th class="border border-white">NIM</th>
                                <th class="border border-white">Nama</th>
                                <th class="border border-white">Angkatan</th>
                                <th class="border border-white">Prodi</th>
                                <th class="border border-white">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td class="border border-white">{{ $item->nim }}</td>
                                <td class="border border-white">{{ $item->name }}</td>
                                <td class="border border-white">{{ $item->angkatan }}</td>
                                <td class="border border-white">{{ $item->Prodi->name ?? '-' }}</td>
                                <td class="border border-white flex gap-2 items-center justify-center">
                                    <a class="cursor-pointer" href="{{ route('mahasiswa.edit', $item->id) }}">
                                        edit
                                    </a>
                                    <form method="POST" action="{{ route('mahasiswa.delete', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="cursor-pointer">
                                            hapus
                                        </button>
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
