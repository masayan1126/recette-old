<template>
    <section class="section-recipe_detail">
        <div class="wrapper-recipe_detail">
            <ReturnButton :props-function="routerBack" />
            <h5>レシピ詳細</h5>
            <div class="text-right">
                <router-link
                    :to="{
                        name: 'editRecipe',
                        params: { recipeId: selectedRecipeId },
                    }"
                >
                    <i class="fas fa-pencil-alt mr-1"></i>編集
                </router-link>
            </div>

            <div class="d-md-flex">
                <div class="w-100">
                    <img
                        class="w-100"
                        :src="selectedRecipe[0].recipe_image_path"
                        alt="選択したレシピの画像"
                    />

                    <p class="">
                        {{ selectedRecipe[0].recipe_name }}
                    </p>
                </div>

                <div class="mb-4 w-100">
                    <p class="mb-0">材料</p>
                    <div class="container-recipe_ingredient-recipe_detail">
                        <ul
                            v-for="selectedRecipeIngredient in selectedRecipe[0]
                                .recipe_ingredients"
                            :key="selectedRecipeIngredient.id"
                        >
                            <li>
                                {{
                                    selectedRecipeIngredient.recipe_ingredient_name
                                }}
                                {{
                                    selectedRecipeIngredient.recipe_ingredient_quantity
                                }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>

                    <span
                        v-if="selectedRecipe[0].recipe_url != null"
                        class="color-link_menu"
                    >
                        <a
                            :href="selectedRecipe[0].recipe_url"
                            target="_blank"
                            rel="noopener"
                            ><i class="mr-1 fas fa-book-open"></i>レシピURL</a
                        >
                    </span>
                    <span v-else>
                        <i class="mr-1 fas fa-book-open"></i>レシピURL
                    </span>
                </div>
                <div class="container-recipe_procedure-recipe_detail p-2">
                    <ul
                        class="pl-1"
                        v-for="(recipeProcedure, index) in selectedRecipe[0]
                            .recipe_procedure"
                        :key="recipeProcedure.toString(index)"
                    >
                        <li>
                            <span
                                v-if="
                                    selectedRecipe[0].recipe_procedure.length >
                                    0
                                "
                                >{{ index + 1 }}</span
                            >.{{ recipeProcedure }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>カテゴリー</span>
                </div>
                <div class="container-recipe_category-recipe_detail p-2">
                    {{ selectedRecipe[0].recipe_category }}
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
    components: {
        ReturnButton,
    },
    mixins: [utilsMixin],
    name: "RecipeDetail",
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        selectedRecipeId() {
            const recipeId = window.location.pathname.split("/recipes/")[1];
            return recipeId;
        },
        selectedRecipe() {
            return this.recipes.filter(
                (recipe) => recipe.id == this.selectedRecipeId
            );
        },
    },
};
</script>
