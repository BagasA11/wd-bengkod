<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Daftar janji Periksa Pasien' }}
        </h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
            </div>
        @endif
</x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Janji Pasien') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.create') }}" class="btn btn-primary">Tambah Obat</a>

                            @if (session('status') === 'periksa-created')
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
                                
                                <th scope="col">no antre</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Jadwal</th>
                                <th scope="col">biaya</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($janji_periksas as $janji)
                                <tr>
                                    <td class="align-middle text-start">
                                        {{ $janji->no_antrian }}
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $janji->user->name }}
                                    </td>
                                    
                                    <td class="align-middle text-start">
                                        {{ $janji->keluhan }}
                                        <!-- {{ 'Rp' . number_format(100000, 0, ',', '.') }} -->
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $janji->jadwal_periksas->hari}}
                                    </td>
                                    <td>
                                        @if($janji->periksa !== NULL)
                                        {{ 'Rp' . number_format($janji->periksa->biaya, 0, ',', '.') }}
                                        @else
                                        {{ 'Rp' . number_format(0, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="flex items-center gap-3">
                                        @if(!$janji->periksa)
                                        <a href="{{ route('dokter.memeriksa.periksa', $janji->id) }}" class="btn btn-secondary btn-sm me-3">
                                            Periksa
                                        </a>
                                        @else
                                        <a href="{{ route('dokter.memeriksa.edit', $janji->id) }}" class="btn btn-primary btn-sm me-3">
                                            edit
                                        </a>
                                        @endif

                                        <!-- {{-- Button Delete --}}
                                        <form action="{{ '#' }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form> -->
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

<script>
    setTimeout(function() {
        let alert = document.querySelector(".alert");
        if (alert) {
            alert.classList.remove("show"); // Bootstrap akan menyembunyikan alert
        }
    }, 3000);
</script>