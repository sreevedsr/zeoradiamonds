/**
 * Enable Enter-to-Next keyboard navigation for .input-field elements.
 * Optionally specify a next target (e.g., an "Add Item" button) to focus after the last input.
 *
 * @param {HTMLElement} container - Scope (defaults to document).
 * @param {string|null} nextTargetSelector - Selector for the element to focus after the last field.
 */
export function enableSequentialInput(container = document, nextTargetSelector = null) {
    const inputs = Array.from(container.querySelectorAll(".input-field")).filter(
        (el) => !el.readOnly && !el.disabled
    );

    inputs.forEach((input, index) => {
        input.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();

                // Handle dropdown fields
                const isDropdown = input.dataset?.type === "dropdown";
                if (isDropdown) {
                    input.click();
                    return;
                }

                // Find next visible, enabled input
                let next = inputs[index + 1];
                while (next && (next.offsetParent === null || next.readOnly || next.disabled)) {
                    next = inputs[inputs.indexOf(next) + 1];
                }

                if (next) {
                    next.focus();
                } else if (nextTargetSelector) {
                    // 🟣 Focus the next target instead of submitting
                    const nextTarget =
                        container.querySelector(nextTargetSelector) ||
                        document.querySelector(nextTargetSelector);

                    if (nextTarget) {
                        nextTarget.focus();
                        // Uncomment to auto-open modal:
                        // nextTarget.click();
                    }
                } else {
                    // 🟣 Default: submit form (for other pages)
                    const form = input.closest("form");
                    if (form) {
                        const submitBtn = form.querySelector("#submitBtn");
                        if (submitBtn) {
                            submitBtn.focus();
                            submitBtn.click();
                        } else {
                            form.requestSubmit?.();
                        }
                    }
                }
            }
        });
    });
}

/**
 * Focus the first visible, enabled input when the form loads.
 * @param {HTMLElement} container - Optional container scope.
 */
export function focusFirstInput(container = document) {
    const firstInput = Array.from(container.querySelectorAll(".input-field")).find(
        (el) => el.offsetParent !== null && !el.readOnly && !el.disabled
    );
    if (firstInput) firstInput.focus();
}
