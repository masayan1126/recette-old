<template>
    <section class="h-100">
        <div v-if="userData.loggedIn == true">
            <Navbar />
            <NavbarTop />
            <NavbarTopHamburger />
        </div>
        <div class="container h-100 pt-4 px-1" style="padding-bottom: 5rem">
            <RouterView />
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
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
    mounted() {
        console.log(this.userData.loggedIn);
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
        }),
    },
    methods: {},
};
</script>
