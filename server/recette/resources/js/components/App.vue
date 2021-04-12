<template>
    <section class="h-100">
        <div v-if="userData.loggedIn == true">
            <Navbar />
            <NavbarTop />
            <NavbarTopHamburger />
        </div>
        <div class="container h-100 pt-3 px-1">
            <RouterView />
            <div class="module_spacer-lg"></div>
        </div>
    </section>
</template>

<script>
import { mapGetters } from "vuex";
import Navbar from "./common/Navbar";
import NavbarTop from "./common/NavbarTop";
import NavbarTopHamburger from "./common/NavbarTopHamburger";
export default {
    components: {
        Navbar,
        NavbarTop,
        NavbarTopHamburger,
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
        }),
    },
    name: "App",
};
</script>
