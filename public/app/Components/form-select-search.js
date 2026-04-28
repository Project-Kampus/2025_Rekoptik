function selectSearchData() {
    return {
        open: false,
        search: "",
        selectedValue: null,
        selectedLabel: "",
        allOptions: [],
        filteredOptions: [],
        labelKey: "label",
        valueKey: "value",
        extraLabels: [],
        placeholder: "Pilih...",

        init() {
            // Read all data from this element (using Alpine.js $el)
            this.allOptions = JSON.parse(
                this.$el.getAttribute("data-options") || "[]",
            );
            this.selectedValue = JSON.parse(
                this.$el.getAttribute("data-selected") || "null",
            );
            this.labelKey = this.$el.getAttribute("data-label-key") || "label";
            this.valueKey = this.$el.getAttribute("data-value-key") || "value";
            this.extraLabels = JSON.parse(
                this.$el.getAttribute("data-extra-labels") || "[]",
            );
            this.placeholder =
                this.$el.getAttribute("data-placeholder") || "Pilih...";

            // Initialize filtered options
            this.filteredOptions = this.allOptions;

            if (this.selectedValue !== null && this.selectedValue !== "") {
                let found = this.allOptions.find(
                    (opt) => this.getValue(opt) == this.selectedValue,
                );

                if (found) {
                    this.selectedLabel = this.getLabel(found);
                }
            }
        },

        getLabel(option) {
            return typeof option === "object" ? option[this.labelKey] : option;
        },

        getValue(option) {
            return typeof option === "object" ? option[this.valueKey] : option;
        },

        filterOptions() {
            let keyword = this.search.toLowerCase();

            this.filteredOptions = this.allOptions.filter((opt) => {
                return this.getLabel(opt).toLowerCase().includes(keyword);
            });
        },

        select(option) {
            this.selectedValue = this.getValue(option);
            this.selectedLabel = this.getLabel(option);
            this.open = false;
            this.search = "";

            // Dispatch change event on hidden input
            const hiddenInput = this.$el.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.dispatchEvent(
                    new Event("change", { bubbles: true }),
                );
            }
        },

        isSelected(option) {
            return this.getValue(option) == this.selectedValue;
        },

        capitalizeFirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },

        formatExtraLabel(label, value) {
            // Format harga as currency
            if (label.toLowerCase() === "harga" && !isNaN(value)) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                }).format(value);
            }
            return value;
        },
    };
}
