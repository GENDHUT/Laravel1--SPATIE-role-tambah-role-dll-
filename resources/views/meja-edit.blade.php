<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-gray-200 leading-tight">
            {{ isset($meja) ? __('Edit Meja Nomor ') . $meja->nomor_meja : __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class=" text-white text-2xl font-bold mb-6">Edit Meja</h1>

    <form action="{{ route('meja.update', $meja->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
    
        <div>
            <label for="nomor_meja" class="block text-sm font-medium text-white">Nomor Meja:</label>
            <input type="text" id="nomor_meja" name="nomor_meja" value="{{ $meja->nomor_meja }}" 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    
        <div>
            <label for="status" class="block text-sm font-medium text-white">Status:</label>
            <select id="status" name="status" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="tersedia" {{ $meja->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipesan" {{ $meja->status === 'dipesan' ? 'selected' : '' }}>Dipesan</option>
            </select>
        </div>
    
        <button type="submit" 
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Simpan
        </button>
    </form>
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


