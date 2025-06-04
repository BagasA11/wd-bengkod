<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Tambah Jadwal') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk menambahkan jadwal praktek ke dalam sistem.') }}
                            </p>
                        </header>

                        <form class="mt-6" id="formJadwalPeriksa" action="{{ route('dokter.jadwal-periksa.store') }}" method="POST">
                            @csrf

                            {{-- Pilih Hari --}}
                            <div class="mb-3 form-group">
                                <label for="hari" class='me-3'>Hari</label>
                                <select id="hari">
                                    @foreach ($days as $hari)
                                        <option value="{{ $hari }}">{{ $hari }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pilih Jam Mulai --}}
                            <div class="mb-3 form-group">
                                <label for="jam-mulai">jam-mulai</label>
                                <input type="time" id="jam-mulai" name="jam_mulai">
                            </div>

                            {{-- Pilih jam Selesai --}}
                            <div class="mb-3 form-group">
                                <label for="jam-selesai">jam-selesai</label>
                                <input type="time" id="jam-selesai" name="jam_selesai">
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
