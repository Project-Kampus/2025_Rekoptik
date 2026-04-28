function multiSelect() {
    return {
        open: false,
        selected: [],
        options: [],
        labelKey: "name",
        valueKey: "id",

        init() {
            const el = this.$el;
            this.options = JSON.parse(el.dataset.options || "[]");
            this.selected = JSON.parse(el.dataset.selected || "[]").map(String);
            this.labelKey = el.dataset.labelKey;
            this.valueKey = el.dataset.valueKey;
        },

        getLabel(option) {
            return option[this.labelKey] ?? "-";
        },

        getValue(option) {
            return String(option[this.valueKey]);
        },

        isSelected(option) {
            return this.selected.includes(this.getValue(option));
        },

        toggle(option) {
            const val = this.getValue(option);

            if (this.selected.includes(val)) {
                this.selected = this.selected.filter((i) => i !== val);
            } else {
                this.selected.push(val);
            }

            // Dispatch change event on container
            this.$el.dispatchEvent(new Event("change", { bubbles: true }));
        },
    };
}
