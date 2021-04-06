<template>
    <div
        @click.prevent="
            propsFunction(
                targetCategoryRecipeList[0].recipe_category,
                targetCategoryRecipeList[0].recipe_category_sub
            )
        "
    >
        <li
            class="d-flex justify-content-between align-items-center py-2"
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
            <span>{{ targetCategoryRecipeList.length }}</span>
        </li>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "RecipeCategory",
    props: ["propsFunction", "recipeCategory"],
    components: {},
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        targetCategoryRecipeList() {
            return this.recipes.filter(
                (recipe) =>
                    recipe.recipe_category_sub == this.recipeCategory.url
            );
        },
    },
    mounted() {
        console.log(this.targetCategoryRecipeList);
    },
    methods: {
        ...mapMutations([]),
        goToPreviousPage() {
            this.$router.back();
        },
    },
};
</script>
