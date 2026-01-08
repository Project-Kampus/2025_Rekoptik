<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Manajemen User
      </h2>
   </x-slot>

   <x-slot name="headerAction">
      <a href="{{ route('admin.create') }}"
         class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
         + Tambah User
      </a>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      {{-- Header --}}
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
         <div>
            <h2 class="text-lg font-medium text-gray-900">
               Tabel User
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               Kelola user dan role (admin, bpjs, dimkes).
            </p>
         </div>

         {{-- Search & Filter Role --}}
         <form method="GET" action="{{ route('admin.index') }}" class="flex gap-2 flex-wrap items-end">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / email"
               class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <select name="role" class="rounded-md border-gray-300 text-sm">
               <option value="">Semua Role</option>
               @foreach(['admin','bpjs','dimkes'] as $role)
               <option value="{{ $role }}" @selected(request('role')==$role)>{{ ucfirst($role) }}</option>
               @endforeach
            </select>

            <button type="submit"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900">
               Filter
            </button>

            @if(request('q') || request('role'))
            <a href="{{ route('admin.index') }}"
               class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
               Reset
            </a>
            @endif
         </form>
      </div>

      {{-- Table --}}
      <div class="overflow-x-auto">
         <table class="min-w-full border border-gray-200 rounded-md text-sm">
            <thead class="bg-gray-50">
               <tr>
                  <th class="border px-2 py-1">NO</th>
                  <th class="border px-2 py-1">Nama</th>
                  <th class="border px-2 py-1">Email</th>
                  <th class="border px-2 py-1">Role</th>
                  <th class="border px-2 py-1">Dibuat</th>
                  <th class="border px-2 py-1">Aksi</th>
               </tr>
            </thead>
            <tbody>
               @forelse($admins as $index => $user)
               <tr class="even:bg-gray-50">
                  <td class="border px-2 py-1">{{ $admins->firstItem() + $index }}</td>
                  <td class="border px-2 py-1">{{ $user->name }}</td>
                  <td class="border px-2 py-1">{{ $user->email }}</td>
                  <td class="border px-2 py-1">
                     {{ $user->roles->pluck('name')->map(fn($r)=>ucfirst($r))->join(', ') }}
                  </td>
                  <td class="border px-2 py-1">{{ $user->created_at->format('d-m-Y') }}</td>
                  <td class="px-4 py-2 border text-center">
                     <div class="flex justify-center gap-3">
                        <!-- Edit -->
                        <a href="{{ route('admin.edit', $user->id) }}"
                           class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
                           Edit
                        </a>

                        <!-- Hapus -->
                        <button
                           type="button"
                           class="px-2 py-1 text-xs rounded bg-red-100 text-red-700 hover:bg-red-200"
                           onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-user-{{ $user->id }}' }))">
                           Hapus
                        </button>
                     </div>
                  </td>
               </tr>
               {{-- Modal Hapus --}}
               <x-danger-modal id="delete-user-{{ $user->id }}" title="Hapus User">
                  <p>
                     Apakah Anda yakin ingin menghapus user
                     <strong>{{ $user->name }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                           type="submit"
                           class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                           Ya, Hapus
                        </button>
                     </form>
                  </x-slot>
               </x-danger-modal>
               @empty
               <tr>
                  <td colspan="6" class="text-center py-2">Belum ada user</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-4">
         {{ $admins->links() }}
      </div>
   </div>
</x-app-layout>