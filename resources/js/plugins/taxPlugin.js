import taxHelper from '../components/taxHelper';

export default function (Alpine) {
    Alpine.magic("taxType", () => {
        const helper = taxHelper();
        return () => helper.get();
    });
}
