<template>
    <li
        @click.prevent="propsFunction(selectedCategoryRecipeList)"
        class="d-flex justify-content-between align-items-center py-3"
        style="border-bottom: 1px solid #c4c4c4"
    >
        <div>
            <img
                class="element-category_image-recipe_category_list"
                :src="recipeCategory.recipe_category_image"
                alt="レシピカテゴリーの画像"
            />
            {{ recipeCategory.recipe_category }}
            {{ recipeCategory.recipe_category_name }}
        </div>
        <span>{{ selectedCategoryRecipeList.length }}</span>
    </li>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        selectedCategoryRecipeList() {
            return this.recipes.filter(
                (recipe) =>
                    recipe.recipe_category_index == this.recipeCategory.index
            );
        },
    },
    name: "RecipeCategory",
    props: ["propsFunction", "recipeCategory"],
};
</script>
