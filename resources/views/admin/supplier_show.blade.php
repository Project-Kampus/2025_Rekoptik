<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Detail Supplier
      </h2>
   </x-slot>

   <div class="space-y-6">

      <div class="bg-white rounded-lg border p-6">
         <div class="flex items-start justify-between">
            <div>
               <h3 class="text-lg font-semibold text-gray-900">
                  {{ $supplier->nama }}
               </h3>
            </div>

            <a href="{{ route('supplier.edit', $supplier->id) }}"
               class="px-3 py-1 text-xs rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
               Edit Supplier
            </a>

         </div>

         <dl class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
               <dt class="text-gray-500">Kontak</dt>
               <dd class="text-gray-900 font-medium">
                  {{ $supplier->kontak ?? '-' }}
               </dd>
            </div>

            <div>
               <dt class="text-gray-500">Alamat</dt>
               <dd class="text-gray-900 font-medium">
                  {{ $supplier->alamat ?? '-' }}
               </dd>
            </div>

            <div>
               <dt class="text-gray-500">Dibuat</dt>
               <dd class="text-gray-900 font-medium">
                  {{ $supplier->created_at->format('d M Y') }}
               </dd>
            </div>

            <div>
               <dt class="text-gray-500">Terakhir Update</dt>
               <dd class="text-gray-900 font-medium">
                  {{ $supplier->updated_at->format('d M Y') }}
               </dd>
            </div>
         </dl>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

         <div class="bg-white rounded-lg border p-6">
            <p class="text-sm text-gray-500">Total Frame</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">
               {{ $supplier->frames->count() }}
            </p>
         </div>

         <div class="bg-white rounded-lg border p-6">
            <p class="text-sm text-gray-500">Total Lensa</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">
               {{ $supplier->lensas->count() }}
            </p>
         </div>

      </div>

      <div class="bg-white rounded-lg border p-6">
         <h3 class="text-lg font-medium text-gray-900 mb-4">
            Daftar Frame dari Supplier
         </h3>

         <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
               <thead class="bg-gray-50">
                  <tr class="text-left text-gray-600">
                     <th class="px-4 py-2 border">Kode</th>
                     <th class="px-4 py-2 border">Merk</th>
                     <th class="px-4 py-2 border">Warna</th>
                     <th class="px-4 py-2 border">Bahan</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($supplier->frames as $frame)
                  <tr class="hover:bg-gray-50">
                     <td class="px-4 py-2 border">{{ $frame->kode_frame }}</td>
                     <td class="px-4 py-2 border">{{ $frame->merk }}</td>
                     <td class="px-4 py-2 border">{{ $frame->warna }}</td>
                     <td class="px-4 py-2 border">{{ $frame->bahan }}</td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                        Tidak ada data frame
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>

      <div class="bg-white rounded-lg border p-6">
         <h3 class="text-lg font-medium text-gray-900 mb-4">
            Daftar Lensa dari Supplier
         </h3>

         <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
               <thead class="bg-gray-50">
                  <tr class="text-left text-gray-600">
                     <th class="px-4 py-2 border">Nama Lensa</th>
                     <th class="px-4 py-2 border">Kategori</th>
                     <th class="px-4 py-2 border">Material</th>
                     <th class="px-4 py-2 border">Coating</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($supplier->lensas as $lensa)
                  <tr class="hover:bg-gray-50">
                     <td class="px-4 py-2 border">{{ $lensa->nama_lensa }}</td>
                     <td class="px-4 py-2 border">{{ ucfirst($lensa->kategori) }}</td>
                     <td class="px-4 py-2 border">{{ $lensa->material ?? '-' }}</td>
                     <td class="px-4 py-2 border">{{ $lensa->coating ?? '-' }}</td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                        Tidak ada data lensa
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>

   </div>
</x-app-layout>