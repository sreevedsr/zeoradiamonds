export default function merchantForm(stateCodes = [], oldCode = '', oldState = '') {
    return {
        states: stateCodes,
        selectedCode: oldCode,
        selectedState: oldState,
        searchQuery: '',
        openDropdown: false,
        manualEdit: false,

        init() {
            if (this.selectedCode) {
                const found = this.states.find(s => s.state_code === this.selectedCode);
                if (found) {
                    this.searchQuery = `${found.state_code} - ${found.state_name}`;
                    this.selectedState = found.state_name;
                }
            }
        },

        get filteredStates() {
            if (!this.searchQuery) return this.states;
            const q = this.searchQuery.toLowerCase();
            return this.states.filter(s =>
                s.state_code.toLowerCase().includes(q) ||
                s.state_name.toLowerCase().includes(q) ||
                (s.gstin_code && s.gstin_code.toLowerCase().includes(q))
            );
        },

        selectState(state) {
            this.selectedCode = state.state_code;
            this.selectedState = state.state_name;
            this.searchQuery = `${state.state_code} - ${state.state_name}`;
            this.openDropdown = false;
            this.manualEdit = false;
        }
    };
}
