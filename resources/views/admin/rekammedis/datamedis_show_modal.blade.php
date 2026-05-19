  <!-- MODAL LENGKAPI/PERBAIKI DOKUMEN -->
  <div id="dokumenModal"
      class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4 backdrop-blur-sm">
      <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
          <!-- Header -->
          <div
              class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex justify-between items-center rounded-t-xl">
              <h3 class="text-lg font-bold flex items-center">
                  <span id="modalTitle">Lengkapi Dokumen</span>
              </h3>
              <button onclick="closeDokumenModal()"
                  class="text-white hover:text-blue-100 text-2xl transition">&times;</button>
          </div>

          <!-- Form -->
          <form action="{{ route('datamedis.storeDokumnet', [$RmPemeriksaan->id]) }}" method="POST"
              enctype="multipart/form-data" class="px-6 pb-6 pt-2 space-y-5">
              @csrf

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Pilih Dokumen</label>
                  <select name="dokumen_id" id="dokumenSelect" required
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                      <option value="">-- Pilih Dokumen --</option>
                      @foreach ($allDokumens as $dokumen)
                          @php
                              $uploaded = $uploadedDokumens->get($dokumen->id);
                          @endphp
                          <option value="{{ $dokumen->id }}" data-status="{{ $uploaded ? 'exist' : 'empty' }}">
                              {{ $dokumen->nama }}
                              @if ($uploaded)
                                  (Perbaiki)
                              @else
                                  (Lengkapi)
                              @endif
                          </option>
                      @endforeach
                  </select>
              </div>

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Upload File</label>
                  <div class="relative">
                      <input type="file" name="file" id="fileInput" required
                          accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" />
                  </div>
                  <p class="text-xs text-gray-500 mt-2 flex items-center">
                      <span class="mr-1">ℹ️</span>
                      Format: PDF, JPG, PNG, DOC, DOCX (Max 1MB)
                  </p>
              </div>

              <!-- File Preview -->
              <div id="filePreview" class="hidden bg-gray-50 border border-gray-200 rounded-lg p-4">
                  <p class="text-xs font-semibold text-gray-600 mb-2">Preview File:</p>
                  <p id="previewName" class="text-sm text-gray-800 font-medium truncate"></p>
                  <p id="previewSize" class="text-xs text-gray-500"></p>
              </div>

              <!-- Action Buttons -->
              <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                  <button type="button" onclick="closeDokumenModal()"
                      class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                      Batal
                  </button>
                  <button type="submit"
                      class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition flex items-center">
                      <span id="submitBtnText">Upload</span>
                  </button>
              </div>
          </form>
      </div>
  </div>

  <script>
      // Handle modal open
      function openDokumenModal() {
          document.getElementById('dokumenModal').classList.remove('hidden');
          document.getElementById('dokumenModal').classList.add('flex');
          document.body.style.overflow = 'hidden';
      }

      // Handle modal close
      function closeDokumenModal() {
          document.getElementById('dokumenModal').classList.add('hidden');
          document.getElementById('dokumenModal').classList.remove('flex');
          document.body.style.overflow = 'auto';
          resetForm();
      }

      // Close when clicking outside
      document.getElementById('dokumenModal').addEventListener('click', function(e) {
          if (e.target === this) {
              closeDokumenModal();
          }
      });

      // Update button text and title based on selection
      const dokumenSelect = document.getElementById('dokumenSelect');
      const modalTitle = document.getElementById('modalTitle');
      const submitBtnText = document.getElementById('submitBtnText');

      dokumenSelect.addEventListener('change', function() {
          const selectedOption = this.options[this.selectedIndex];
          const status = selectedOption.dataset.status;

          if (status === 'exist') {
              modalTitle.textContent = 'Perbaiki Dokumen';
              submitBtnText.textContent = 'Perbarui';
          } else {
              modalTitle.textContent = 'Lengkapi Dokumen';
              submitBtnText.textContent = 'Upload';
          }
      });

      // File preview
      document.getElementById('fileInput').addEventListener('change', function() {
          const file = this.files[0];
          const preview = document.getElementById('filePreview');
          const previewName = document.getElementById('previewName');
          const previewSize = document.getElementById('previewSize');

          if (file) {
              previewName.textContent = file.name;
              previewSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
              preview.classList.remove('hidden');
          } else {
              preview.classList.add('hidden');
          }
      });

      // Reset form
      function resetForm() {
          document.querySelector('form').reset();
          document.getElementById('filePreview').classList.add('hidden');
          dokumenSelect.value = '';
      }
  </script>

  <!-- MODAL TAMBAH PEMBAYARAN -->
  <div id="pembayaranModal"
      class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4 backdrop-blur-sm">
      <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
          <!-- Header -->
          <div
              class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 flex justify-between items-center rounded-t-xl">
              <h3 class="text-lg font-bold flex items-center">
                  Tambah Pembayaran
              </h3>
              <button onclick="closePembayaranModal()"
                  class="text-white hover:text-green-100 text-2xl transition">&times;</button>
          </div>

          <!-- Form -->
          <form action="{{ route('datamedis.storePembayaran', [$RmPemeriksaan->id]) }}" method="POST"
              enctype="multipart/form-data" class="pt-2 px-6 pb-6 space-y-5">
              @csrf

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Tanggal Pembayaran</label>
                  <input type="date" name="tanggal_bayar" required
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white" />
              </div>

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Kategori Pembayaran</label>
                  <select name="kategori" required
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white">
                      <option value="">-- Pilih Kategori --</option>
                      @if ($RmPemeriksaan->pasien->kategori === 'bpjs')
                          <option value="bpjs">BPJS</option>
                      @elseif ($RmPemeriksaan->pasien->kategori === 'asuransi')
                          <option value="asuransi">Asuransi</option>
                      @endif
                      <option value="dp">Uang Muka</option>
                      <option value="lunas">Bayar Lunas</option>
                  </select>
              </div>

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Metode Pembayaran</label>
                  <select name="metode" required
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white">
                      <option value="">-- Pilih Metode --</option>
                      <option value="non_tunai">Non Tunai</option>
                      <option value="tunai">Tunai</option>
                  </select>
              </div>

              <div>
                  <label class="block text-sm font-bold text-gray-800 mb-2">Jumlah Pembayaran</label>
                  <x-form-input name="jumlah" class="mt w-full" type="rupiah" value="{{ old('jumlah') }}"
                      placeholder="0" max="{{ $sisaPembayaran }}" required />
              </div>

              <!-- Action Buttons -->
              <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                  <button type="button" onclick="closePembayaranModal()"
                      class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                      Batal
                  </button>
                  <button type="submit"
                      class="px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition flex items-center">
                      Simpan Pembayaran
                  </button>
              </div>
          </form>
      </div>
  </div>

  <script>
      // Handle pembayaran modal
      function openPembayaranModal() {
          document.getElementById('pembayaranModal').classList.remove('hidden');
          document.getElementById('pembayaranModal').classList.add('flex');
          document.body.style.overflow = 'hidden';
      }

      function closePembayaranModal() {
          document.getElementById('pembayaranModal').classList.add('hidden');
          document.getElementById('pembayaranModal').classList.remove('flex');
          document.body.style.overflow = 'auto';
          resetPembayaranForm();
      }

      document.getElementById('pembayaranModal').addEventListener('click', function(e) {
          if (e.target === this) {
              closePembayaranModal();
          }
      });

      function resetPembayaranForm() {
          document.querySelector('#pembayaranModal form').reset();
      }
  </script>

  {{-- MODAL PENGAMBILAN --}}
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
          @if ($sisaPembayaran > 0)
              <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                  <p class="font-semibold">Pembayaran Belum Selesai</p>
                  <p class="text-sm">Selesaikan pembayaran terlebih dahulu sebelum melakukan pengambilan.</p>
              </div>
          @else
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
                              class="w-full bg-white cursor-crosshair block"
                              style="touch-action: none; user-select: none;"></canvas>
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
                      <p class="text-xs text-gray-500 mt-2">Tanda tangan akan otomatis disimpan ke sistem saat form
                          disubmit
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
          @endif
      </div>
  </div>

  <script>
      let canvas = null;
      let ctx = null;
      let isDrawing = false;

      let canvasInitialized = false;

      function initSignatureCanvas() {
          canvas = document.getElementById('signatureCanvas');
          ctx = canvas.getContext('2d');

          // Set canvas size
          const rect = canvas.getBoundingClientRect();
          canvas.width = rect.width;
          canvas.height = rect.height;
          canvas.style.touchAction = 'none';
          canvas.style.userSelect = 'none';

          if (canvasInitialized) {
              clearSignature();
              return;
          }

          // Pointer events cover mouse, touch, and pen/stylus
          canvas.addEventListener('pointerdown', startDrawing);
          canvas.addEventListener('pointermove', draw);
          canvas.addEventListener('pointerup', stopDrawing);
          canvas.addEventListener('pointercancel', stopDrawing);
          canvas.addEventListener('pointerleave', stopDrawing);

          canvasInitialized = true;
      }

      function startDrawing(e) {
          if (e.pointerType === 'mouse' && e.button !== 0) return;
          e.preventDefault();
          isDrawing = true;
          const rect = canvas.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          ctx.beginPath();
          ctx.moveTo(x, y);
          if (e.pointerId) {
              canvas.setPointerCapture(e.pointerId);
          }
      }

      function draw(e) {
          if (!isDrawing) return;
          e.preventDefault();
          const rect = canvas.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          ctx.lineWidth = 2;
          ctx.lineCap = 'round';
          ctx.strokeStyle = '#000';
          ctx.lineTo(x, y);
          ctx.stroke();
      }

      function stopDrawing(e) {
          isDrawing = false;
          if (e && e.pointerId && canvas) {
              canvas.releasePointerCapture(e.pointerId);
          }
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
          if (window.sisaPembayaran > 0) {
              alert('Pembayaran belum selesai. Selesaikan pembayaran terlebih dahulu sebelum melakukan pengambilan.');
              return;
          }

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
      const pengambilanForm = document.getElementById('pengambilanForm');
      if (pengambilanForm) {
          pengambilanForm.addEventListener('submit', function(e) {
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
      }

      // Close modal when clicking outside
      document.getElementById('pengambilanModal').addEventListener('click', function(e) {
          if (e.target === this) {
              closePengambilanModal();
          }
      });
  </script>
