export default function taxHelper() {
    return {
        get() {
            const sf = document.querySelector('[x-data^="saleForm"]')?._x;

            if (!sf) return "-";

            const taxType = sf.$data.taxType;

            if (!taxType) return "-";

            return taxType === "igst"
                ? "IGST (3%)"
                : "CGST + SGST (1.5% + 1.5%)";
        }
    };
}
