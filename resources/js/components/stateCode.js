export default function stateCode(
    stateCodes = [],
    oldCode = "",
    oldState = "",
) {
    return {
        states: stateCodes,
        selectedCode: oldCode,
        selectedState: oldState,
        selectedGST: "",
        searchQuery: "",
        openDropdown: false,
        manualEdit: false,

        init() {
            if (this.selectedCode) {
                const found = this.states.find(
                    (s) => s.state_code === this.selectedCode,
                );
                if (found) {
                    this.searchQuery = `GST: ${this.selectedGST || "-"} (${found.state_code})`;
                    this.selectedState = found.state_name;
                }
            }
        },

        get filteredStates() {
            if (!this.searchQuery) return this.states;
            const q = this.searchQuery.toLowerCase();
            return this.states.filter(
                (s) =>
                    s.state_code.toLowerCase().includes(q) ||
                    s.state_name.toLowerCase().includes(q) ||
                    (s.gstin_code && s.gstin_code.toLowerCase().includes(q)),
            );
        },

        selectState(state) {
            this.selectedCode = state.state_code;
            this.selectedState = state.state_name;
            this.selectedGST = state.gstin_code || "-";
            this.searchQuery = `GST: ${this.selectedGST} (${state.state_code})`;
            this.openDropdown = false;
            this.manualEdit = false;
        },
    };
}
