export default function editModal() {
    return {

        openFromJson(id, jsonPrefix, inputPrefix, modalName, routeBase) {
            const el = document.getElementById(`${jsonPrefix}-${id}`);
            if (!el) return;

            const data = JSON.parse(el.textContent);
            this.openModal(data, modalName, inputPrefix, routeBase);
        },

        openModal(data, modalName, inputPrefix, routeBase) {
            this.$dispatch('open-modal', modalName);

            setTimeout(() => {
                for (const key in data) {
                    const input = document.getElementById(`${inputPrefix}-${key}`);
                    if (input) {
                        input.value = data[key] ?? '';
                    }
                }

                const form = document.getElementById(`${inputPrefix}Form`);
                if (form) {
                    form.action = `${routeBase}/${data.id}`;
                }
            }, 40);
        }
    };
}
