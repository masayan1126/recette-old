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
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('createRecipe')"
                    >
                        <i class="mr-1 fas fa-folder-plus"></i>レシピ追加
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('favoriteRecipeList')"
                    >
                        <i class="mr-1 fas fa-clipboard-list"></i>お気に入り
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('recipeCategoryList')"
                    >
                        <i class="mr-1 fas fa-folder-plus"></i>レシピを探す
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('recipeCategoryList')"
                    >
                        <i class="mr-1 far fa-calendar-alt"></i>カレンダー
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import utilsMixin from "../../mixin/utility";
export default {
    name: "NavbarTopHumburger",
    mixins: [utilsMixin],
    props: [],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    computed: {
        ...mapGetters({}),
    },
    methods: {
        ...mapMutations([]),
    },
};
</script>
