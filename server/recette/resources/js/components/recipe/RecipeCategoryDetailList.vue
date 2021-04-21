<template>
    <section class="section-recipe_category_detail_list">
        <div class="wrapper-recipe_category_detail_list">
            <ReturnButton :props-function="routerBack" />
            <div class="mb-4 mt-4">
                <h5>
                    カテゴリーから探す/
                    <span class="small">{{
                        selectedCategory[0].recipe_category_name
                    }}</span>
                </h5>
                <div class="container-recipe_category_detail_list mt-4">
                    <ul class="w-100">
                        <li
                            class="d-flex justify-content-between align-items-center py-3"
                            @click.prevent="showRecipeDetail(selectedRecipe.id)"
                            v-for="selectedRecipe in selectedRecipeCategoryList"
                            :key="selectedRecipe.id"
                            style="border-bottom: 1px solid #c4c4c4"
                        >
                            <div>
                                <img
                                    alt="選択されたカテゴリーのレシピ画像"
                                    class="element-category_image-recipe_category_detail_list"
                                    :src="selectedRecipe.recipe_image_path"
                                />
                                {{ selectedRecipe.recipe_name }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters } from "vuex";
import BreadCrumb from "../common/BreadcrumbTrail";
import RecipeCategories from "../../assets/recipeCategories";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";

export default {
    components: { BreadCrumb, ReturnButton },
    name: "RecipeCategoryDetailList",
    mixins: [utilsMixin],
    data() {
        return {
            categories: RecipeCategories.categories,
        };
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        selectedCategoryIndex() {
            const categoryIndex = window.location.pathname.split(
                "/recipes/category/"
            )[1];
            return categoryIndex;
        },
        selectedCategory() {
            return this.categories.filter(
                (category) => category.index == this.selectedCategoryIndex
            );
        },
        selectedRecipeCategoryList() {
            return this.recipes.filter(
                (recipe) =>
                    recipe.recipe_category_index == this.selectedCategoryIndex
            );
        },
    },
    methods: {
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: {
                    recipeId: recipeId,
                },
            });
        },
    },
};
</script>
