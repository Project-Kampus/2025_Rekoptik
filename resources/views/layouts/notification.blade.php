 @if (session('success') || session('error') || $errors->any())
 <div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition:enter="transform transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transform transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-20 right-6 z-50 max-w-sm w-full">
    <div class="
        flex items-start gap-3
        px-4 py-3 rounded-lg shadow-lg border
        @if (session('success'))
            bg-green-50 border-green-200
        @elseif (session('error') || $errors->any())
            bg-red-50 border-red-200
        @endif
    ">
       <!-- Close Button (Left) -->
       <button
          @click="show = false"
          class="text-gray-400 hover:text-gray-600 focus:outline-none">
          ✕
       </button>

       <!-- Content -->
       <div class="flex-1 text-sm">
          @if (session('success'))
          <p class="font-medium text-green-700">
             {{ session('success') }}
          </p>
          @elseif (session('error'))
          <p class="font-medium text-red-700">
             {{ session('error') }}
          </p>
          @elseif ($errors->any())
          <p class="font-medium text-red-700 mb-1">
             Terjadi kesalahan:
          </p>
          <ul class="list-disc list-inside text-red-600">
             @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
             @endforeach
          </ul>
          @endif
       </div>
    </div>
 </div>
 @endif