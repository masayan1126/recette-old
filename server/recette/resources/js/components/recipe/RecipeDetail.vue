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

            <div class="d-lg-flex mb-3 justify-content-between">
                <div class="w-100 w-lg-49">
                    <img
                        class="w-100"
                        :src="selectedRecipe[0].recipe_image_path"
                        alt="選択したレシピの画像"
                    />

                    <p class="">
                        {{ selectedRecipe[0].recipe_name }}
                    </p>
                </div>

                <div class="w-100 w-lg-49">
                    <p class="mb-0">材料</p>
                    <div class="container-recipe_ingredient-recipe_detail">
                        <ul>
                            <li
                                v-for="selectedRecipeIngredient in selectedRecipe[0]
                                    .recipe_ingredients"
                                :key="selectedRecipeIngredient.id"
                            >
                                {{
                                    selectedRecipeIngredient.recipe_ingredient_name
                                }}
                                {{
                                    selectedRecipeIngredient.recipe_ingredient_quantity
                                }}
                            </li>
                        </ul>
                        <p class="mb-0 text-right">
                            調理時間：{{ selectedRecipeCookingTime[0].name }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>

                    <span
                        v-if="selectedRecipe[0].recipe_url != null"
                        class="color-link_menu font_size-resize"
                    >
                        <a
                            :href="selectedRecipe[0].recipe_url"
                            target="_blank"
                            rel="noopener"
                            ><i class="mr-1 fas fa-book-open"></i>レシピURL</a
                        >
                    </span>
                    <span class="font_size-resize" v-else>
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
            <div class="mb-4 d-lg-flex justify-content-between">
                <div class="w-lg-49">
                    <div class="d-flex justify-content-between align-items-end">
                        <span>ジャンル</span>
                    </div>
                    <div class="container-recipe_category-recipe_detail p-2">
                        {{ selectedRecipeGenre[0].name }}
                    </div>
                </div>
                <div class="w-lg-49">
                    <div class="d-flex justify-content-between align-items-end">
                        <span>カテゴリー</span>
                    </div>
                    <div class="container-recipe_category-recipe_detail p-2">
                        {{ selectedRecipe[0].recipe_category }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CookingTimeList from "../../assets/cookingTimeList";
import RecipeGenres from "../../assets/recipeGenres";
import { mapGetters } from "vuex";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        ReturnButton,
    },
    mixins: [utilsMixin],
    name: "RecipeDetail",
    data() {
        return {
            cookingTimeList: CookingTimeList.cookingTimeList,
            recipeGenres: RecipeGenres.recipeGenres,
        };
    },
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
        selectedRecipeCookingTime() {
            return this.cookingTimeList.filter(
                (cookingTime) =>
                    cookingTime.index ==
                    this.selectedRecipe[0].cooking_time_index
            );
        },
        selectedRecipeGenre() {
            return this.recipeGenres.filter(
                (recipeGenre) =>
                    recipeGenre.index ==
                    this.selectedRecipe[0].recipe_genre_index
            );
        },
    },
};
</script>
