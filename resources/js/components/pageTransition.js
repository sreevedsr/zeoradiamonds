export default function pageTransition() {
    return {
        show: false,
        loaded: false,
        init() {
            const darkMode = document.documentElement.classList.contains('dark');
            const img = new Image();
            img.src = darkMode
                ? '/assets/img/login-office-dark.jpeg'
                : '/assets/img/login.jpeg';
            img.onload = () => {
                this.loaded = true;
                setTimeout(() => (this.show = true), 100);
            };
            window.addEventListener('beforeunload', () => (this.show = false));
        },
    };
}
