<!-- dokter dashboard -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex gap-3 flex-wrap p-3">
                <div class="p-6 text-gray-900">
                    {{ Auth::user()->name; }}
                </div>
                <div class="p-6 text-gray-900 bg-light">
                    {{ 'poli '.$dokter->poli->nama_poli }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
