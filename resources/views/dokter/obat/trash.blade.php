<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat Hapus') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.index') }}" class="btn btn-primary">Kembali</a>

                            @if (session('status') === 'obat-recovered')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 bg-success"
                                >
                                    {{ __('Obat Berhasil dipulihkan') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Id-obat</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Deleted AT</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat)
                                <tr>
                                    <th scope="row" class="align-middle text-start">
                                        {{ $obat->id }}
                                    </th>
                                    <td class="align-middle text-start">
                                        {{ $obat->nama_obat }}
                                    </td>
                                    <td class="align-middle text-start">
                                        {{ $obat->deleted_at }}
                                    </td>
                                   
                                    <td class="flex items-center gap-3">
                                        {{-- Button Edit --}}
                                       <form action="{{ route('dokter.obat.recover', $obat->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-secondary">Recover</button>
                                        </form>

                                        {{-- Button Delete --}}
                                        <form action="{{ route('dokter.obat.force-delete', $obat->id) }}" method="POST">
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