function formatRupiah(angka) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(angka || 0);
}

function getSelectedOption(selectEl) {
    if (!selectEl) return null;
    const options = JSON.parse(selectEl.dataset.options || "[]");
    const value = selectEl.querySelector('input[type="hidden"]')?.value;

    return options.find((opt) => String(opt.id) === String(value));
}

function getSelectedMultiple(selectEl) {
    if (!selectEl) return [];
    const options = JSON.parse(selectEl.dataset.options || "[]");

    const hiddenInputs = selectEl.querySelectorAll('input[type="hidden"]');
    let values = [];

    hiddenInputs.forEach((input) => {
        if (input.value) {
            values.push(input.value);
        }
    });

    return options.filter((opt) => values.map(String).includes(String(opt.id)));
}

function updateSummary() {
    let total = 0;

    // ===== FRAME =====
    const frameEl = document.getElementById("frame_select");
    const frame = getSelectedOption(frameEl);

    if (frame) {
        document.getElementById("summary_frame").innerText = frame.kode_frame;
        document.getElementById("summary_frame_price").innerText = formatRupiah(
            frame.harga,
        );
        total += parseInt(frame.harga || 0);
    } else {
        document.getElementById("summary_frame").innerText = "-";
        document.getElementById("summary_frame_price").innerText = "Rp 0";
    }

    // ===== LENSA =====
    const lensaEl = document.getElementById("lensa_select");
    const lensa = getSelectedOption(lensaEl);

    if (lensa) {
        document.getElementById("summary_lensa").innerText = lensa.nama_lensa;
        document.getElementById("summary_lensa_price").innerText = formatRupiah(
            lensa.harga,
        );
        total += parseInt(lensa.harga || 0);
    } else {
        document.getElementById("summary_lensa").innerText = "-";
        document.getElementById("summary_lensa_price").innerText = "Rp 0";
    }

    // ===== AKSESORIS =====
    const aksEl = document.getElementById("aksesoris_select");
    const aksesoris = getSelectedMultiple(aksEl);

    let aksHtml = "";
    let aksTotal = 0;

    if (aksesoris.length > 0) {
        aksesoris.forEach((item) => {
            aksHtml += `<p class="text-gray-800">${item.nama} - ${formatRupiah(item.harga)}</p>`;
            aksTotal += parseInt(item.harga || 0);
        });
    } else {
        aksHtml = `<p class="text-gray-500 italic">Belum ada</p>`;
    }

    document.getElementById("summary_aksesoris").innerHTML = aksHtml;
    document.getElementById("summary_aksesoris_price").innerText =
        formatRupiah(aksTotal);

    total += aksTotal;

    // ===== TOTAL & UPDATE HIDDEN INPUT =====
    document.getElementById("summary_total").innerText = formatRupiah(total);
    document.getElementById("biaya_kacamata").value = total;
}

// ===== SETUP EVENT LISTENERS =====
function setupOrderCalculatorListeners() {
    const frameSelect = document.getElementById("frame_select");
    const lensaSelect = document.getElementById("lensa_select");
    const aksSelect = document.getElementById("aksesoris_select");

    // Frame
    if (frameSelect) {
        frameSelect.addEventListener("change", updateSummary);
    }

    // Lensa
    if (lensaSelect) {
        lensaSelect.addEventListener("change", updateSummary);
    }

    // Aksesoris
    if (aksSelect) {
        aksSelect.addEventListener("change", updateSummary);
    }
}

// Trigger awal ketika DOM sudah siap
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () {
        setupOrderCalculatorListeners();
        updateSummary();
    });
} else {
    setupOrderCalculatorListeners();
    updateSummary();
}
