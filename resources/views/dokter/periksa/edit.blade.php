<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Buat Janji Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atur jadwal pertemuan dengan dokter untuk mendapatkan layanan konsultasi dan pemeriksaan kesehatan sesuai kebutuhan Anda.') }}
                            </p>
                        </header>
                  

                       
                        <form class="mt-6" action="{{ route('dokter.memeriksa.update', $janji_periksa->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaPasien">Nama Pasien</label>
                                            <input type="text" class="rounded form-control" id="namaPasien"
                                                placeholder="Example input" value="{{ $janji_periksa->user->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keluhanPasien">Keluhan</label>
                                            <textarea class="rounded form-control" id="keluhanPasien"
                                                placeholder="Example input" readonly>{{ $janji_periksa->keluhan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">

                                <h6>
                                    jadwal: {{ $janji_periksa->jadwal_periksas->hari.
                                        ', '.
                                        $janji_periksa->jadwal_periksas->jam_mulai.
                                        ' - '.
                                         $janji_periksa->jadwal_periksas->jam_selesai
                                    }}
                                </h6>
                                
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="edit_tanggal">Tanggal Periksa</label>
                                <input type='datetime-local' class="rounded form-control" name='tgl_periksa' id="edit_tanggal" 
                                required value="{{$janji_periksa->periksa->tgl_periksa}}">
                            </div>

                            <div class="form-group">
                                <label for="edit_catatan">Catatan Dokter</label>
                                <input type="text" class="form-control" name="catatan" id="edit_catatan" value="{{$janji_periksa->periksa->catatan}}">
                            </div>

                            <div class="form-group">
                                <label for="obatSelect">Pilih Obat</label>
                                <select class="form-control" id="edit_obat" name="obats[]" required 
                                multiple onchange="hitungBiaya()">
                                    @foreach ($obats as $obat)
                                        <option value="{{$obat->id}}" data-harga="{{ $obat->harga }}"
                                        {{in_array($obat->id, $janji_periksa->periksa->detail_periksa->pluck('id_obat')->toArray())? 'selected':'' }}>
                                            {{ $obat->nama_obat.' - '.$obat->kemasan.' - '.
                                                'Rp' . number_format($obat->harga, 0, ',', '.')
                                            }}
                                        </option>
                                    @endforeach
                                   
                                </select>
                            </div>
                                
                            <div class="form-group">
                                <label for="edit_biaya">Total Biaya</label>
                                <input type="text" class="rounded form-control" id="edit_biaya" 
                                    value="{{$janji_periksa->periksa->biaya}}" readonly name='biaya'>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>

                                <!-- @if (session('status') === 'janji-periksa-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Berhasil Dibuat.') }}</p>
                                @endif -->
                            </div>
                            

                        </form>
                        <script>
                            
                            document.addEventListener("DOMContentLoaded", function () {
                                const oldDate = document.getAttribute('old-date');
                                document.getElementById('tanggal').value = oldDdate;
                            });

                            function hitungBiaya(){
                                let biayaAwal = 150000;
                                let total = biayaAwal;
                                const select = document.getElementById('edit_obat');
                                const selectedOptions = Array.from(select.selectedOptions);
                                selectedOptions.forEach(option => {
                                    total += parseInt(option.getAttribute('data-harga'));
                                });
                                document.getElementById('edit_biaya').value = total;
                            }
                            setTimeout(function() {
                                let alert = document.querySelector(".alert");
                                if (alert) {
                                    alert.classList.remove("show"); // Bootstrap akan menyembunyikan alert
                                }
                            }, 3000);

                           
                        </script>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>