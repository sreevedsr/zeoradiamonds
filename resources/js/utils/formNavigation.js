/**
 * Enable Enter-to-Next keyboard navigation for .input-field elements.
 * Optionally specify a next target (e.g., an "Add Item" button) to focus before submitting.
 *
 * @param {HTMLElement} container - Scope (defaults to document).
 * @param {string|null} nextTargetSelector - Selector for the element to focus after the last input.
 */
export function enableSequentialInput(container = document, nextTargetSelector = null) {
    const inputs = Array.from(container.querySelectorAll(".input-field")).filter(
        (el) => !el.readOnly && !el.disabled && el.offsetParent !== null
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
                    return;
                }

                // 🟣 Focus Add Item button (or next target) if present
                const nextTarget =
                    (nextTargetSelector &&
                        (container.querySelector(nextTargetSelector) ||
                            document.querySelector(nextTargetSelector))) ||
                    null;

                if (nextTarget) {
                    // Ensure button is focusable
                    nextTarget.setAttribute("tabindex", nextTarget.getAttribute("tabindex") || "0");

                    // Delay focus slightly to avoid Alpine reactivity issues
                    setTimeout(() => {
                        nextTarget.focus({ preventScroll: true });
                    }, 50);
                    return; // ✅ stop here, don't submit yet
                }

                // 🟣 Default: submit form (only if no Add Item button found)
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
