<!-- Modal Pengambilan Pesanan -->
<div id="pengambilanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">
                Form Pengambilan Pesanan
            </h3>
            <button type="button" onclick="closePengambilanModal()"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <form id="pengambilanForm" action="" method="POST" class="space-y-4">
            @csrf

            <!-- Nama Pengambil -->
            <div>
                <label for="nama_pengambil" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Pengambil <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_pengambil" name="nama_pengambil" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama pengambil" />
            </div>

            <!-- Hubungan Pengambil -->
            <div>
                <label for="hub_pengambil" class="block text-sm font-medium text-gray-700 mb-1">
                    Hubungan Pengambil <span class="text-red-500">*</span>
                </label>
                <select id="hub_pengambil" name="hub_pengambil" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Hubungan --</option>
                    <option value="Diri Sendiri">Diri Sendiri</option>
                    <option value="Suami/Istri">Suami/Istri</option>
                    <option value="Orang Tua">Orang Tua</option>
                    <option value="Anak">Anak</option>
                    <option value="Saudara">Saudara</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Whiteboard Signature -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tanda Tangan Penerima <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-gray-300 rounded-lg bg-gray-50 overflow-hidden">
                    <canvas id="signatureCanvas" width="400" height="200"
                        class="w-full bg-white cursor-crosshair touch-none block"></canvas>
                </div>
                <div class="flex gap-2 mt-2">
                    <button type="button" onclick="clearSignature()"
                        class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-sm hover:bg-gray-400">
                        Hapus
                    </button>
                    <button type="button" onclick="savePNG()"
                        class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                        Unduh TTD
                    </button>
                </div>
                <input type="hidden" id="bukti_pengambil" name="bukti_pengambil" required />
                <p class="text-xs text-gray-500 mt-2">Tanda tangan akan otomatis disimpan ke sistem saat form disubmit
                </p>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button" onclick="closePengambilanModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 text-sm font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium">
                    Simpan Pengambilan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let canvas = null;
    let ctx = null;
    let isDrawing = false;

    function initSignatureCanvas() {
        canvas = document.getElementById('signatureCanvas');
        ctx = canvas.getContext('2d');

        // Set canvas size
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;

        // Mouse events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch events
        canvas.addEventListener('touchstart', handleTouch);
        canvas.addEventListener('touchmove', handleTouch);
        canvas.addEventListener('touchend', stopDrawing);
    }

    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        ctx.beginPath();
        ctx.moveTo(x, y);
    }

    function draw(e) {
        if (!isDrawing) return;
        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#000';
        ctx.lineTo(x, y);
        ctx.stroke();
    }

    function handleTouch(e) {
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : 'mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById('bukti_pengambil').value = '';
    }

    function savePNG() {
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = 'tanda_tangan_' + Date.now() + '.png';
        link.click();
    }

    function openPengambilanModal(pemeriksaanId) {
        document.getElementById('pengambilanModal').classList.remove('hidden');
        document.getElementById('pengambilanForm').action = '/datamedis/' + pemeriksaanId + '/storePengambilan';

        // Reset form
        document.getElementById('pengambilanForm').reset();
        // clearSignature();

        // Initialize canvas
        initSignatureCanvas();
    }

    function closePengambilanModal() {
        document.getElementById('pengambilanModal').classList.add('hidden');
    }

    // Save signature data before form submission
    document.getElementById('pengambilanForm').addEventListener('submit', function(e) {
        const signatureData = canvas.toDataURL('image/png');
        document.getElementById('bukti_pengambil').value = signatureData;

        if (signatureData ===
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='
        ) {
            e.preventDefault();
            alert('Mohon buat tanda tangan terlebih dahulu');
            return false;
        }
    });

    // Close modal when clicking outside
    document.getElementById('pengambilanModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePengambilanModal();
        }
    });
</script>
