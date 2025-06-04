<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
</x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary">Tambah Obat</a>
                        
                            @if (session('status') === 'obat-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >
                                    {{ __('Created.') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <th scope="row" class="align-middle text-start">
                                        {{ $jadwal->id }}
                                    </th>
                                    <td class="align-middle text-start">
                                        {{ $jadwal->hari }}
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $jadwal->jam_mulai }}
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $jadwal->jam_selsai }}
                                    </td>
                                    <td class="align-middle text-start">
                                        @if ($jadwal->status)
                                        <p>{{ "Aktif" }}</p>
                                        @elseif (!$jadwal->status)
                                        <p>{{ "Non Aktif" }}</p>
                                        @endif
                                    </td>
                                    <!-- aksi -->
                                    <td class="flex items-center gap-3">
                                        {{-- Button enable or  disable --}}
                                        @if (!$jadwal->status)
                                        <a href="{{ route('dokter.jadwal-periksa.enable', $jadwal->id) }}" class="btn btn-secondary btn-sm me-3">
                                            Aktifkan
                                        </a>
                                        @elseif ($jadwal->status) 
                                        <a href="{{ route('dokter.jadwal-periksa.disable', $jadwal->id) }}" class="btn btn-danger btn-sm me-3">
                                            Non Aktifkan
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Button Delete --}}
                                        <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwal->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr></tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
