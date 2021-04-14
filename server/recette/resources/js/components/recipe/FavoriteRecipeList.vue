<template>
    <section class="section-favorite_recipe_list">
        <div class="wrapper-favorite_recipe_list">
            <ReturnButton :props-function="routerBack" />
            <h5>お気に入りレシピ</h5>
            <div class="mb-4">
                <div
                    class="container-favorite_recipe_list w-100 d-flex flex-wrap"
                >
                    <div
                        class="w-100 element-recipe-favorite_recipe_list"
                        v-for="favoriteRecipe in favoriteRecipes"
                        :key="favoriteRecipe.id"
                    >
                        <img
                            alt="お気に入りレシピの画像"
                            class="w-100"
                            @click="showRecipeDetail(favoriteRecipe.id)"
                            :src="favoriteRecipe.recipe_image_path"
                        />
                        <p>{{ favoriteRecipe.recipe_name }}</p>
                        <hr class="d-sm-none" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters } from "vuex";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";
export default {
    mixins: [utilsMixin],
    name: "FavoriteRecipeList",
    components: {
        ReturnButton,
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        favoriteRecipes() {
            return this.recipes.filter((recipe) => recipe.is_favorite == 1);
        },
    },
    methods: {
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: { recipeId: recipeId },
            });
        },
    },
};
</script>
