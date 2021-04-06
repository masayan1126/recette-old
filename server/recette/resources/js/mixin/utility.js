export default {
    methods: {
        routerBack() {
            this.$router.back();
        },
        transitionToNext(pathName) {
            document
                .getElementById("navbarToggleExternalContent")
                .classList.toggle("show");
            this.$router.push({ name: pathName });
        },
    },
};
