<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Detail janji Periksa Pasien' }}
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
                            {{ __('Detail Janji Pasien') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-primary">Kembali</a>
                            <a href="{{ route('dokter.memeriksa.edit', $janji_periksa->id) }}" class="btn btn-success">Edit</a>
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
                    <!-- <p>{{ $janji_periksa->keluhan }}</p>
                    <p>{{ $janji_periksa->no_antrian }}</p>
                    <p>{{ $janji_periksa->periksa->catatan }}</p>
                    <p>{{ $janji_periksa->periksa->biaya }}</p>
                    <p>{{ $janji_periksa->periksa->tgl_periksa }}</p> -->
                    <div class="container">
                    
                    <div class="body mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <p>Nama Pasien: {{$janji_periksa->user->name}}</p>
                            </div>
                            <div class="col-md-4">
                                <p>Nomor Urut: {{$janji_periksa->no_urut}}</p>
                            </div>
                            <div class="col-md-4">
                                <p>Tanggal Periksa: {{ $janji_periksa->periksa->tgl_periksa }}</p>
                            </div>
                        </div>

                        <div class="card mt-3 rounded-lg">
                            <div class="card-body">
                                <p>Catatan Dokter: {{$janji_periksa->periksa->catatan}}</p>
                            </div>
                        </div>
                        
                        <div class="row justify-content-between my-3">
                            
                            <h2 class="text-lg font-medium text-gray-900">
                                Total: {{$janji_periksa->periksa->biaya}}
                            </h2>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-success">Tambah Obat</button>
                            </div>
                        </div>

                        </div>
                    </div>

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