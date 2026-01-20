class DataDumyFormMedis {
    setVal(selector, value) {
        const el = document.querySelector(selector);
        if (el) el.value = value;
    }

    setTextarea(name, value) {
        const el = document.querySelector(`textarea[name="${name}"]`);
        if (el) el.value = value;
    }

    setSelectIndex(name, index = 1) {
        const el = document.querySelector(`select[name="${name}"]`);
        if (el && el.options.length > index) {
            el.selectedIndex = index;
            el.dispatchEvent(new Event("change"));
        }
    }

    fill() {
        /* =====================
           DATA PEMERIKSAAN
        ====================== */
        this.setVal('input[name="no_sep"]', "SEP-001234");
        this.setVal("input[name='kebiasaan']", "Sering menatap layar komputer");

        this.setTextarea("keluhan_utama", "Pandangan kabur saat melihat jauh");
        this.setTextarea(
            "riwayat_penyakit",
            "Tidak ada riwayat penyakit serius",
        );
        this.setTextarea("diagnosa", "Miopia Ringan");
        this.setTextarea("penyakit_sekarang", "Miopia sejak 2 tahun terakhir");
        this.setTextarea("penyakit_keluarga", "Orang tua menggunakan kacamata");
        this.setTextarea("pengobatan", "Belum ada pengobatan khusus");

        /* =====================
           RESEP KACAMATA
        ====================== */
        this.setVal('input[name="resep_dari"]', "dr. Andi SpM");
        this.setVal('input[name="resep_tanggal"]', "2026-01-20");

        ["kanan", "kiri"].forEach((mata) => {
            this.setVal(`input[name="resep[${mata}][sph]"]`, "-1.50");
            this.setVal(`input[name="resep[${mata}][cyl]"]`, "-0.50");
            this.setVal(`input[name="resep[${mata}][axis]"]`, "180");
            this.setVal(`input[name="resep[${mata}][add]"]`, "+1.00");
            this.setVal(`input[name="resep[${mata}][pd]"]`, "62");
        });

        /* =====================
           PESANAN
        ====================== */
        this.setSelectIndex("frame_id");
        this.setSelectIndex("lensa_id");
        this.setSelectIndex("aksesoris_id");

        this.setVal('input[name="biaya_kacamata"]', "750000");
        this.setVal('input[name="tanggal_dipesan"]', "2026-01-20");
        this.setVal('input[name="tanggal_pengambilan"]', "2026-01-25");

        console.log("✅ Data dummy berhasil diisi");
    }
}

/* =====================
   GLOBAL FUNCTION
====================== */
window.dataDumy = function () {
    new DataDumyFormMedis().fill();
};
