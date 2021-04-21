<template>
    <section class="section-recipe_category_list">
        <div class="wrapper-recipe_category_list">
            <ReturnButton :props-function="routerBack" />
            <div class="mb-4 mt-4">
                <h5>カテゴリーから探す</h5>
                <div class="container-recipe_category_list mt-4">
                    <ul class="mb-0">
                        <RecipeCategory
                            v-for="(category, index) in categories"
                            :key="category.id"
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[index]"
                        />
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import RecipeCategory from "./RecipeCategory";
import RecipeCategories from "../../assets/recipeCategories";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        ReturnButton,
        RecipeCategory,
    },
    mixins: [utilsMixin],
    name: "RecipeCategoryList",
    data() {
        return {
            categories: RecipeCategories.categories,
        };
    },
    methods: {
        showRecipeCategoryDetail(selectedCategoryRecipeList, recipeCategory) {
            if (selectedCategoryRecipeList.length == 0) {
                alert("該当のレシピは0件です。");
                return;
            }

            console.log(selectedCategoryRecipeList);
            this.$router.push({
                name: "recipeCategoryDetailList",
                params: {
                    categoryPath:
                        selectedCategoryRecipeList[0].recipe_category_index,
                },
            });
        },
    },
};
</script>
