<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="py-12">

    </div> --}}
@if (Auth()->user()->hasRole('admin'))

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1>List of Users</h1>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Name</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Role</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ ucfirst($user->roles->first()->name ?? 'No Role') }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('users.editRole', $user->id) }}" class="bg-orange-500 hover:bg-orange-700 text-white py-2 px-4 rounded">Edit</a>

                                    @if($user->mejas->isEmpty())
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" disabled>
                                        @foreach ($user->mejas as $meja)
                                            <span class="text-white">Tidak Bisa Di Hapus Karena Memiliki Meja: {{ $meja->nomor_meja }}</span>
                                        @endforeach                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif





{{-- Meja --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Meja</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Status</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mejas as $meja)
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('waiter') || auth()->user()->hasRole('kasir') || auth()->user()->hasRole('owner'))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $meja->nomor_meja }}</td>
                            <td>{{ $meja->status }}</td>
                            <td class="flex space-x-1">
                                @if($meja->status === 'tersedia' && $meja->user_id === null)
                                    <form action="{{ route('meja.reserveTable', $meja->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @if (auth()->user()->hasRole('admin'))
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded mr-1.25">
                                            Pesan
                                        </button>
                                    </form>
                                    <a href="{{ route('meja.edit', $meja->id) }}" class="bg-orange-500 hover:bg-orange-700 text-white py-2 px-4 rounded mr-1.25 inline-block">
                                        Edit
                                    </a>
                                    <form action="{{ route('meja.hapus', $meja->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded inline-block">
                                            Hapus
                                        </button>
                                    </form>
                                    @endif

                            </td>
                        </tr>
                @elseif($meja->user_id === auth()->id())
                    Sudah Dipesan
                    <form action="{{ route('meja.finishTable', $meja->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Tandai Selesai
                        </button>
                    </form>
                @else
                    Sudah Dipesan oleh {{ $meja->user->name }}
                    <form action="{{ route('meja.finishTable', $meja->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Tandai Selesai
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @elseif(auth()->user()->hasRole('pelanggan'))
        @if($meja->user_id === auth()->id())
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $meja->nomor_meja }}</td>
                <td>{{ $meja->status }}</td>
                <td class="flex space-x-1">
                    Sudah Dipesan
                    <form action="{{ route('meja.finishTable', $meja->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Tandai Selesai
                        </button>
                    </form>
                </td>
            </tr>
        @elseif($meja->status === 'tersedia' && $meja->user_id === null && auth()->user()->mejas()->count() === 0)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $meja->nomor_meja }}</td>
                <td>{{ $meja->status }}</td>
                <td>
                    <form action="{{ route('meja.reserveTable', $meja->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            Pesan
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endif
@endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

{{-- Tambah Meja Admin --}}
@if (Auth()->user()->hasRole('admin'))
{{-- Meja AUTO --}}
    <section>
        <div class="py-12">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Tambah Meja Auto') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Tambahkan meja baru dengan nama dan jumlah yang diinginkan.') }}
            </p>
        </header>

        <form method="post" action="{{ route('meja.addMultiple') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="nama_meja" :value="__('Nama Meja')" />
                <x-text-input id="nama_meja" name="nama_meja" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nama_meja')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="jumlah_meja" :value="__('Jumlah Meja')" />
                <x-text-input id="jumlah_meja" name="jumlah_meja" type="number" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('jumlah_meja')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Tambah Meja') }}</x-primary-button>

                @if (session('status') === 'meja-added')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Meja telah ditambahkan.') }}</p>
                @endif
            </div>
        </form>
    </div>
    </section>

{{-- Meja MANUAL --}}

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Tambah Meja Manual') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Tambahkan meja baru dengan nama dan status tersedia.') }}
        </p>
    </header>

    <form method="post" action="{{ route('meja.addManual') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="nama_meja" :value="__('Nama Meja')" />
            <x-text-input id="nama_meja" name="nama_meja" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('nama_meja')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Tambah Meja') }}</x-primary-button>

            @if (session('status') === 'meja-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Meja telah ditambahkan.') }}</p>
            @endif
        </div>
    </form>
</section>
   @endif
        </div>
    </div>
</div>
{{--
tambhakan jika user ingin filter view berdasarkan role
@if (Auth()->user()->hasRole('admin')||Auth()->user()->hasRole('waiter'))
   @endif

if (permisi)
--}}
</x-app-layout>


