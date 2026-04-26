<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Identitas Pasien
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('identitaspasien.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Pasien
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Identitas Pasien
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data identitas pasien rekam medis.
                </p>
            </div>

            <form method="GET" action="{{ route('identitaspasien.index') }}" class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama / nomor kartu / email"
                    class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    Cari
                </button>

                @if (request('q'))
                    <a href="{{ route('identitaspasien.index') }}"
                        class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-4 py-3 border">Nama Pasien</th>
                        <th class="px-4 py-3 border">No. Kartu</th>
                        <th class="px-4 py-3 border">No. HP</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">Umur</th>
                        <th class="px-4 py-3 border">Kategori</th>
                        <th class="px-4 py-3 border">Alamat</th>
                        <th class="px-4 py-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($rmPasiens as $pasien)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">
                                {{ $pasien->nama_pasien }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $pasien->no_kartu ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $pasien->no_hp ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $pasien->email ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $pasien->umur ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                <span
                                    class="px-2 py-1 rounded text-xs font-medium
                                    @if ($pasien->kategori === 'bpjs') bg-blue-100 text-blue-800
                                    @elseif($pasien->kategori === 'asuransi') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($pasien->kategori) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                {{ substr($pasien->alamat ?? '-', 0, 30) }}{{ strlen($pasien->alamat ?? '-') > 30 ? '...' : '' }}
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center gap-2">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('identitaspasien.edit', $pasien->id) }}"
                                            class="px-2 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                    @endif
                                    <a href="{{ route('identitaspasien.show', $pasien->id) }}"
                                        class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                Data pasien belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-500 mt-1">
            Menampilkan {{ $rmPasiens->count() }} dari {{ $rmPasiens->total() }} data pasien
        </p>

        <div class="mt-2">
            {{ $rmPasiens->links() }}
        </div>

    </div>

</x-app-layout>
