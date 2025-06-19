<!-- pasien dashboard -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard pasien') }}
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-300">
                    {{ __("Daftar Janji Periksa") }}
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                    </div>
                @endif

            </div>
            <table class="table mt-6 overflow-hidden rounded table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nomor antrian</th>
                        <th scope="col">keluhan</th>
                        <th scope="col">hari</th>
                        <th scope="col">jam</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien->janji_periksas as $janji_periksa)
                        <tr>
                            <th scope="row" class="align-middle text-start">
                                
                            {{ $janji_periksa->id }}
                            </th>
                            <td class="align-middle text-start">
                                {{ $janji_periksa->no_antrian }}
                            </td>
                            <td class="align-middle text-start">
                                {{ $janji_periksa->keluhan }}
                            </td>
                            <td class="align-middle text-start">
                                {{ $janji_periksa->jadwal_periksas->hari }}
                            </td>
                            <td class="align-middle text-start">
                                {{ $janji_periksa->jadwal_periksas->jam_mulai.' - '.$janji_periksa->jadwal_periksas->jam_selesai }}
                            </td>
                            <td class="flex items-center gap-3">
                            
                                {{-- Button Delete --}}
                                @if($janji_periksa->periksa !== NULL)
                                <button type="submit" class="btn btn-secondary btn-sm" disabled>
                                    Disabled
                                </button>
                                @else()
                                <form action="{{ route('pasien.janji-periksa.cancel', $janji_periksa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Batalkan Janji
                                    </button>
                                </form>
                        
                                 {{-- Button Edit --}}
                                <a href="{{ route('pasien.janji-periksa.edit', $janji_periksa->id) }}" class="btn btn-secondary btn-sm me-3">
                                    Edit
                                </a>
                                @endif
                            </td>

                            
                        </tr>
                        <tr></tr>
                    @endforeach
                </tbody>
            </table>
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