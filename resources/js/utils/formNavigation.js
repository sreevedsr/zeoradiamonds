// resources/js/utils/formNavigation.js

/**
 * Enable Enter-to-Next keyboard navigation for all .input-field elements.
 * @param {HTMLElement} container - Optional container to limit scope.
 */
export function enableSequentialInput(container = document) {
    const inputs = Array.from(container.querySelectorAll('.input-field'))
        .filter(el => !el.readOnly && !el.disabled);

    inputs.forEach((input, index) => {
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();

                const isDropdown = input.dataset?.type === 'dropdown';
                if (isDropdown) {
                    // Toggle dropdowns instead of skipping them
                    input.click();
                    return;
                }

                // Move to next enabled input
                let next = inputs[index + 1];
                while (next && (next.offsetParent === null || next.readOnly || next.disabled)) {
                    next = inputs[inputs.indexOf(next) + 1];
                }

                if (next) next.focus();
                else document.querySelector('#submitBtn')?.focus();
            }
        });
    });
}

/**
 * Focus the first visible, enabled input when form loads.
 * @param {HTMLElement} container - Optional container to limit scope.
 */
export function focusFirstInput(container = document) {
    const firstInput = Array.from(container.querySelectorAll('.input-field'))
        .find(el => el.offsetParent !== null && !el.readOnly && !el.disabled);
    if (firstInput) firstInput.focus();
}
