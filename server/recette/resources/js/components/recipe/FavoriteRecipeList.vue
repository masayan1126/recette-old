<template>
    <section class="section-favorite_recipe_list">
        <div class="wrapper-favorite_recipe_list">
            <router-link :to="{ name: 'recipes' }"
                ><i class="fas fa-angle-left fa-2x"></i
            ></router-link>
            <hr />
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
                            @click="showRecipeDetail(favoriteRecipe.id)"
                            class="w-100"
                            :src="favoriteRecipe.recipe_image_path"
                            alt="お気に入りレシピの画像"
                        />
                        <p>{{ favoriteRecipe.recipe_name }}</p>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
    name: "FavoriteRecipeList",
    props: [],
    data() {
        return {};
    },
    computed: {
        favoriteRecipes() {
            return this.recipes.filter((recipe) => recipe.is_favorite == 1);
        },
        ...mapGetters({
            recipes: "getRecipes",
        }),
    },
    created() {},
    mounted() {},
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
