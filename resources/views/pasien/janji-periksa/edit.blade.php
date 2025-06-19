<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
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
                        <!-- <a href="{{ route('pasien.janji-periksa.store') }}">tets</a> -->
                        <form class="mt-6" action="{{ route('pasien.janji-periksa.update', $janji_periksa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                        <div class="form-group">
                                <label for="dokterSelect">Jadwal</label>
                                <select class="form-control" id="dokterSelect" name="id_jadwal_periksa" required>
                                        <option>Pilih Jadwal dan Dokter</option>
                                    @foreach ($jadwal_periksas as $jadwal)
                                        <option value="{{$jadwal->id}}">
                                            {{
                                                $jadwal->dokter->name.' : '.$jadwal->hari.', '.
                                                $jadwal->jam_mulai.' - '.$jadwal->jam_selesai
                                            }}
                                        </option>
                                        
                                    @endforeach
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" name='keluhan' id="keluhan" rows="3" 
                                required value="{{ $janji_periksa->keluhan }}"></textarea>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>

                                @if (session('status') === 'janji-periksa-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Berhasil Dibuat.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>