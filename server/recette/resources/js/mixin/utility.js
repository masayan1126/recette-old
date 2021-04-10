export default {
    methods: {
        routerBack() {
            this.$router.back();
        },
        transitionToNext(pathName) {
            document
                .getElementById("navbarToggleExternalContent")
                .classList.remove("show");
            this.$router.push({ name: pathName });
        },
    },
};
