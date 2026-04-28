<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Frame
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('frame.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Frame
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Frame
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data frame kacamata, stok, dan harga.
                </p>
            </div>

            <form method="GET" action="{{ route('frame.index') }}" class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode / nama / merk"
                    class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    Cari
                </button>

                @if (request('q'))
                    <a href="{{ route('frame.index') }}"
                        class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                        Reset
                    </a>
                @endif
            </form>
        </div>



        {{-- Table --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full">
                <thead class="bg-blue-700 text-white font-bold text-sm">
                    <tr class="text-left ">
                        <th class="px-4 py-3 w-12 whitespace-nowrap">No.</th>
                        <th class="px-4 py-3 ">Kode</th>
                        <th class="px-4 py-3 ">Merk</th>
                        <th class="px-4 py-3 ">Warna</th>
                        <th class="px-4 py-3 ">Bahan</th>
                        @if (auth()->user()->hasRole('superadmin'))
                            <th class="px-4 py-3 ">Harga Modal</th>
                        @endif
                        <th class="px-4 py-3 ">Harga Jual</th>
                        <th class="px-4 py-3 ">Supplier</th>
                        <th class="px-4 py-3  text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @forelse ($frames as $frame)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2">
                                {{ $loop->iteration + ($frames->currentPage() - 1) * $frames->perPage() }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $frame->kode_frame }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $frame->merk ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $frame->warna ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $frame->bahan ?? '-' }}
                            </td>
                            @if (auth()->user()->hasRole('superadmin'))
                                <td class="px-4 py-3 text-right">
                                    @if ($frame->modal && $frame->modal > 0)
                                        Rp {{ number_format($frame->modal, 0, ',', '.') }}
                                    @else
                                        <button type="button"
                                            class="px-3 py-1.5 text-xs bg-orange-500 text-white rounded hover:bg-orange-600 font-medium"
                                            onclick="window.dispatchEvent(
                                            new CustomEvent('open-modal', {
                                                detail: 'verify-modal-{{ $frame->id }}'
                                            })
                                            )">
                                            Verifikasi Harga Modal
                                        </button>

                                        <x-danger-modal id="verify-modal-{{ $frame->id }}"
                                            title="Verifikasi Harga Modal">
                                            <p class="text-sm text-gray-600">
                                                Frame <strong class="text-gray-900">{{ $frame->kode_frame }}</strong>
                                                belum memiliki harga modal.
                                                <br>
                                                Silakan atur harga modal dengan mengedit item ini.
                                            </p>

                                            <x-slot name="actions">
                                                <a href="{{ route('frame.edit', $frame->id) }}"
                                                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                                    Edit & Atur Harga Modal
                                                </a>
                                            </x-slot>
                                        </x-danger-modal>
                                    @endif
                                </td>
                            @endif
                            <td class="px-4 py-2 text-green-600 text-right">
                                Rp {{ number_format($frame->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $frame->supplier->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center gap-2">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('frame.edit', $frame->id) }}"
                                            class="px-2 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <button type="button"
                                            class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600"
                                            onclick="window.dispatchEvent(
                                            new CustomEvent('open-modal', {
                                                detail: 'delete-frame-{{ $frame->id }}'
                                            })
                                        )">
                                            Hapus
                                        </button>

                                        <x-danger-modal id="delete-frame-{{ $frame->id }}" title="Hapus Frame">
                                            <p>
                                                Apakah Anda yakin ingin menghapus frame
                                                <strong>{{ $frame->kode_frame }}</strong>?
                                                <br>
                                                Tindakan ini tidak dapat dibatalkan.
                                            </p>

                                            <x-slot name="actions">
                                                <form action="{{ route('frame.destroy', $frame->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </x-slot>
                                        </x-danger-modal>
                                    @else
                                        <span class="px-3 py-1 text-xs bg-gray-300 text-gray-700 rounded">
                                            Tidak ada aksi
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                Data frame belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-500 mt-1">
            Menampilkan {{ $frames->count() }} dari {{ $frames->total() }} frame
        </p>

        <div class="mt-2">
            {{ $frames->links() }}
        </div>

    </div>


</x-app-layout>
