document.addEventListener("DOMContentLoaded", function () {
    // Handle rupiah currency input with formatting and max limit
    const currencyInputs = document.querySelectorAll(
        '[data-currency="rupiah"]',
    );

    currencyInputs.forEach((displayInput) => {
        // Find the hidden input that comes right after this display input
        const hiddenInput =
            displayInput.nextElementSibling?.classList?.contains(
                "currency-hidden",
            )
                ? displayInput.nextElementSibling
                : null;

        if (!hiddenInput) return;

        const maxValue = displayInput.getAttribute("data-max")
            ? parseInt(displayInput.getAttribute("data-max"))
            : null;

        // Initialize with value from hidden input if exists
        if (hiddenInput.value) {
            displayInput.value = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(hiddenInput.value);
        }

        // Format on input
        displayInput.addEventListener("input", function () {
            let numericValue = this.value.replace(/\D/g, "");

            // Apply max limit if set
            if (maxValue && numericValue && parseInt(numericValue) > maxValue) {
                numericValue = maxValue;
            }

            if (numericValue === "") {
                this.value = "";
                if (hiddenInput) hiddenInput.value = "";
            } else {
                this.value = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                }).format(numericValue);
                if (hiddenInput) hiddenInput.value = numericValue;
            }
        });

        // Format on blur
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

        // Remove format on focus for editing
        displayInput.addEventListener("focus", function () {
            this.value = this.value.replace(/\D/g, "");
        });
    });

    // Handle number input with max limit
    document.querySelectorAll('input[type="number"][max]').forEach((input) => {
        input.addEventListener("blur", function () {
            const maxValue = parseInt(this.getAttribute("max"));
            const currentValue = parseInt(this.value);

            if (currentValue > maxValue) {
                this.value = maxValue;
            }
        });
    });
});
