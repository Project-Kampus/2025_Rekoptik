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

            <form method="GET" action="{{ route('identitaspasien.index') }}" class="flex gap-2 flex-wrap">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama / nomor kartu / email"
                    class="rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                <select name="kategori"
                    class="rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Semua Kategori --</option>
                    <option value="bpjs" @selected(request('kategori') === 'bpjs')>BPJS</option>
                    <option value="asuransi" @selected(request('kategori') === 'asuransi')>Asuransi</option>
                    <option value="umum" @selected(request('kategori') === 'umum')>Umum</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    Cari
                </button>

                @if (request('q') || request('kategori'))
                    <a href="{{ route('identitaspasien.index') }}"
                        class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full">
                <thead class="bg-blue-700 text-sm text-white">
                    <tr class="text-left text-sm ">
                        <th class="px-4 py-3 w-12 whitespace-nowrap">No</th>
                        <th class="px-4 py-3">Nama Pasien</th>
                        {{-- <th class="px-4 py-3">No. Kartu</th> --}}
                        <th class="px-4 py-3">No. HP</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Umur</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @forelse ($rmPasiens as $pasien)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2">
                                {{ $loop->iteration + ($rmPasiens->currentPage() - 1) * $rmPasiens->perPage() }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $pasien->nama_pasien }}
                            </td>
                            {{-- <td class="px-4 py-2">
                                {{ $pasien->no_kartu ?? '-' }}
                            </td> --}}
                            <td class="px-4 py-2">
                                {{ $pasien->no_hp ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $pasien->email ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $pasien->umur ?? '-' }} Tahun
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $kategori = $pasien->kategori;
                                    $kategoriColor = match ($kategori) {
                                        'bpjs' => 'bg-blue-100 text-blue-700',
                                        'asuransi' => 'bg-amber-100 text-amber-700',
                                        'umum' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $kategoriColor }}">
                                    {{ ucfirst($kategori) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ substr($pasien->alamat ?? '-', 0, 30) }}{{ strlen($pasien->alamat ?? '-') > 30 ? '...' : '' }}
                            </td>
                            <td class="px-4 py-2 text-center">
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

        <div class="mt-4">
            {{ $rmPasiens->links() }}
        </div>

    </div>

</x-app-layout>
