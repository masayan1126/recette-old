<template>
    <section class="">
        <Navbar />
        <NavbarTop />
        <NavbarTopHamburger />
        <div class="container pt-4" style="padding-bottom: 5rem">
            <RouterView />
        </div>
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
        return {};
    },
    created() {},
    mounted() {},
    computed: {},
    methods: {},
};
</script>
