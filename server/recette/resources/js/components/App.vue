<template>
    <section>
        <Navbar />
        <NavbarTop />
        <NavbarTopHamburger />
        <RouterView />
    </section>
</template>

<script>
import Navbar from "./common/Navbar";
import NavbarTop from "./common/NavbarTop";
import NavbarTopHamburger from "./common/NavbarTopHamburger";
export default {
    components: {
        Navbar,
        NavbarTop,
        NavbarTopHamburger,
    },
    name: "App",
    props: [],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {},
    mounted() {},
    computed: {},
    methods: {},
};
</script>
