<template>
    <section class="section-recipe_create">
        <div class="wrapper-recipe_create">
            <ReturnButton :path-name="'recipes'" :recipe-id="recipeId" />

            <div class="container-recipe mb-4 mt-2">
                <div class="text-right">
                    <router-link
                        :to="{
                            name: 'editRecipe',
                            params: { recipeId: recipeId },
                        }"
                    >
                        <i class="fas fa-pencil-alt mr-1"></i>編集
                    </router-link>
                </div>
                <img
                    class="w-100"
                    :src="selectedRecipe[0].recipe_image_path"
                    alt=""
                />
                <p class="meal-title__recipe-deatail">
                    {{ selectedRecipe[0].recipe_name }}
                </p>
            </div>

            <div class="container-recipe_ingredient mb-4">
                <p class="mb-0">材料</p>
                <div class="area-ingredient">
                    <ul
                        v-for="selectedRecipeIngredient in selectedRecipe[0]
                            .recipe_ingredients"
                        :key="selectedRecipeIngredient.id"
                    >
                        <li>
                            {{
                                selectedRecipeIngredient.recipe_ingredient_name
                            }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container-recipe_procedure mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>
                    <span class="small">
                        <i class="mr-1 fas fa-book-open"></i>レシピURL
                    </span>
                </div>
                <div class="area-recipe_procedure p-2">
                    <ul
                        class="pl-1"
                        v-for="(recipeProcedure, index) in selectedRecipe[0]
                            .recipe_procedure"
                        :key="recipeProcedure.toString(index)"
                    >
                        <li>{{ index + 1 }}.{{ recipeProcedure }}</li>
                    </ul>
                </div>
            </div>
            <div class="container-recipe_procedure mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>カテゴリー</span>
                </div>
                <div class="area-recipe_procedure p-2">
                    {{ selectedRecipe[0].recipe_category }}
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import ReturnButton from "../parts/ReturnButton";
export default {
    name: "RecipeDetail",
    props: ["recipeId"],
    components: {
        ReturnButton,
    },
    data() {
        return {
            recipeProcedureList: [],
            targetIngredientList: [],
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
        }),
        selectedRecipe() {
            return this.recipes.filter((recipe) => recipe.id == this.recipeId);
        },
    },
    mounted() {
        console.log(this.recipeId);
    },
    methods: {},
};
</script>
