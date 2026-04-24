document.addEventListener("DOMContentLoaded", function () {
    const currencyInputs = document.querySelectorAll(
        '[data-currency="rupiah"]',
    );

    currencyInputs.forEach((displayInput) => {
        // Cari hidden input yang sesuai
        const form = displayInput.closest("form");
        const hiddenInput = form
            ? form.querySelector(".currency-hidden")
            : null;

        if (!hiddenInput) return;

        // Inisialisasi dengan nilai dari hidden input jika ada
        if (hiddenInput.value) {
            displayInput.value = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(hiddenInput.value);
        }

        // Format saat input
        displayInput.addEventListener("input", function (e) {
            let value = this.value.replace(/\D/g, "");
            if (value === "") {
                this.value = "";
                if (hiddenInput) hiddenInput.value = "";
            } else {
                this.value = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                }).format(value);
                if (hiddenInput) hiddenInput.value = value;
            }
        });

        // Format saat fokus hilang
        displayInput.addEventListener("blur", function () {
            if (this.value) {
                let value = this.value.replace(/\D/g, "");
                this.value = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                }).format(value);
                if (hiddenInput) hiddenInput.value = value;
            }
        });

        // Hapus format saat fokus untuk editing
        displayInput.addEventListener("focus", function () {
            this.value = this.value.replace(/\D/g, "");
        });
    });
});
