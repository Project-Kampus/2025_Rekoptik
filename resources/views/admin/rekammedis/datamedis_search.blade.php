<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Pencarian Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    @if($pasiens->count() > 0)
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Pasien</h3>
                        <div class="space-y-4">
                            @foreach($pasiens as $pasien)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <strong>Nama Pasien:</strong> {{ $pasien->nama_pasien }}
                                        </div>
                                        <div>
                                            <strong>No HP:</strong> {{ $pasien->no_hp }}
                                        </div>
                                        <div>
                                            <strong>Email:</strong> {{ $pasien->email }}
                                        </div>
                                        <div>
                                            <strong>Alamat:</strong> {{ $pasien->alamat }}
                                        </div>
                                        <div>
                                            <strong>Umur:</strong> {{ $pasien->umur }}
                                        </div>
                                        <div>
                                            <strong>Kategori:</strong> {{ $pasien->kategori }}
                                        </div>
                                        <div>
                                            <strong>No Kartu:</strong> {{ $pasien->no_kartu }}
                                        </div>
                                        <div>
                                            <strong>Kelas:</strong> {{ $pasien->kelas }}
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('datamedis.create.step2', $pasien) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Pilih Pasien Ini
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada pasien ditemukan dengan nama tersebut.</p>
                        <a href="{{ route('datamedis.create.step1') }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
