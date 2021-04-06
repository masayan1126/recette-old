<template>
    <div class="w-100 shadow">
        <nav class="navbar navbar-top-hamburger">
            <div
                class="navbar-dark d-flex justify-content-between align-items-center"
            >
                <h4 class="mb-0">Recette</h4>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarToggleExternalContent"
                    aria-controls="navbarToggleExternalContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse" id="navbarToggleExternalContent">
                <ul>
                    <li>
                        <a href="">
                            <i class="mr-1 fas fa-folder-plus"></i>レシピ追加
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mr-1 fas fa-clipboard-list"></i>お気に入り
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mr-1 fas fa-folder-plus"></i>食材から献立
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mr-1 far fa-calendar-alt"></i>カレンダー
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
    name: "NavbarTopHumburger",
    props: [],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    computed: {
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
        }),
    },
    methods: {
        ...mapMutations(["setRecipes", "initRecipes"]),
    },
};
</script>
