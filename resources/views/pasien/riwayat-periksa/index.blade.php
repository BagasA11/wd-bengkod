<!-- pasien dashboard -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard pasien') }}
        </h2>
       
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-100">
                    {{ __("Riwayat Periksa") }}
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
                        <th scope="col">ID</th>
                        <th scope="col">Poliklinik</th>
                        <th scope="col">Dokter</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Antrian</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($janji_periksas as $janji_periksa)
                        <!-- @if(!is_null($janji_periksa->periksa)) -->
                            <tr>
                                <th scope="row" class="align-middle text-start">
                                    
                                {{ $janji_periksa->id }}
                                </th>
                                <td class="align-middle text-start">
                                    {{ $janji_periksa->jadwal_periksas->dokter->poli->nama_poli }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janji_periksa->jadwal_periksas->dokter->name }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janji_periksa->jadwal_periksas->hari }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janji_periksa->jadwal_periksas->jam_mulai.' - '.$janji_periksa->jadwal_periksas->jam_selesai }}
                                </td>
                                <td class="align-middle text-start">
                                    {{ $janji_periksa->no_antrian }}
                                </td>
                                <td class="align-middle text-start">
                                    @if( is_null($janji_periksa->periksa) )
                                        <span class="badge badge-pill badge-warning">
                                            {{'Belum Diperiksa'}}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-success">
                                            {{'Sudah Diperiksa'}}
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-start">
                                    @if(is_null($janji_periksa->periksa))
                                    <a href="{{ route('pasien.riwayat-periksa.detail', $janji_periksa->id) }}" class="btn btn-info">Detail</a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="detailModal{{ $janji_periksa->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="detailModalTitle{{ $janji_periksa->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered"
                                            role="document">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold"
                                                        id="riwayatModalLabel{{ $janji_periksa->id }}">
                                                        Detail Riwayat Pemeriksaan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <strong>Poliklinik:</strong>
                                                            {{ $janji_periksa->jadwal_periksas->dokter->poli }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Nama Dokter:</strong>
                                                            {{ $janji_periksa->jadwal_periksas->dokter->nama }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Hari Pemeriksaan:</strong>
                                                            {{ $janji_periksa->jadwal_periksas->hari }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Jam Mulai:</strong>
                                                            {{ \Carbon\Carbon::parse($janji_periksa->jadwal_periksas->jam_mulai)->format('H.i') }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Jam Selesai:</strong>
                                                            {{ \Carbon\Carbon::parse($janji_periksa->jadwal_periksas->jam_selesai)->format('H.i') }}
                                                        </li>
                                                    </ul>

                                                    <!-- Highlight Nomor Antrian -->
                                                    <div class="mt-4 text-center">
                                                        <div class="mb-2 h5 font-weight-bold">Nomor Antrian Anda
                                                        </div>
                                                        <span class="badge badge-primary"
                                                            style="font-size: 1.75rem; padding: 0.6em 1.2em;">
                                                            {{ $janji_periksa->no_antrian }}
                                                        </span>
                                                    </div>
                                                </div>
                                    @else
                                        <a href="{{ route('pasien.riwayat-periksa.riwayat', $janji_periksa->id) }}" class="btn btn-secondary">Riwayat</a>
                                    @endif
                                </td>

                                
                            </tr>
                        <!-- @endif -->
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