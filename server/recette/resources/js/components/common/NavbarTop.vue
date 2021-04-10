<template>
    <nav class="navbar navbar-top shadow w-100">
        <div
            class="navbar-dark d-flex justify-content-between align-items-center h-100"
        >
            <h4
                @click="transitionToNext('recipes')"
                class="mb-0 cursor-pointer"
            >
                Recette
            </h4>
            <ul
                class="container-navbar_top p-0 mb-0 d-flex justify-content-end align-items-center"
            >
                <li
                    @click="transitionToNext('createRecipe')"
                    class="text-center cursor-pointer"
                >
                    レシピ追加
                </li>
                <span>/</span>
                <li
                    @click="transitionToNext('favoriteRecipeList')"
                    class="text-center cursor-pointer"
                >
                    お気に入り
                </li>
                <span>/</span>
                <li
                    @click="transitionToNext('recipeCategoryList')"
                    class="text-center cursor-pointer"
                >
                    レシピを探す
                </li>
                <span>/</span>
                <li
                    @click="transitionToNext('recipeCategoryList')"
                    class="text-center cursor-pointer"
                >
                    カレンダー
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import utilsMixin from "../../mixin/utility";
export default {
    name: "NavbarTop",
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
