<template>
    <section class="section-recipe_category_list">
        <div class="wrapper-recipe_category_list">
            <ReturnButton :path-name="'recipes'" class="d-sm-none" />
            <!-- ぱんくずリスト -->
            <BreadCrumb class="breadcrumb-component" />

            <div class="mb-4 mt-4">
                <h5>カテゴリーから探す</h5>
                <div class="container-recipe_category_list mt-4">
                    <ul class="mb-0">
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[0]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[1]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[2]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[3]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[4]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[5]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[6]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[7]"
                        />
                        <RecipeCategory
                            :props-function="showRecipeCategoryDetail"
                            :recipe-category="categories[8]"
                        />
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ImagePreview from "../parts/ImagePreview";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import InputLabel from "../parts/InputLabel";
import { mapGetters, mapMutations } from "vuex";
import BreadCrumb from "../common/BreadcrumbTrail";
import ReturnButton from "../parts/ReturnButton";
import RecipeCategories from "../../assets/recipeCategories";
import RecipeCategory from "./RecipeCategory";

export default {
    name: "RecipeCategoryList",
    components: {
        ImagePreview,
        PrimaryButton,
        TextInput,
        InputLabel,
        ReturnButton,
        BreadCrumb,
        RecipeCategory,
    },
    data() {
        return {
            categories: RecipeCategories.categories,
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
            recipeIngredientList: "getRecipeIngredientList",
            isEditingIngredient: "getIsEditingRecipeIngredient",
            editingIngredientIndex: "getEditingRecipeIngredientIndex",
        }),
        meatDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "肉料理"
            );
            // return this.recipes;
        },
        fishDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "魚料理"
            );
        },
        vegetableDishes() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "野菜料理"
            );
        },

        noodleDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "麺類"
            );
        },
        riceDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "ご飯もの"
            );
        },
        soupDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "スープ、汁物"
            );
        },
        breadDish() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "パン類"
            );
        },
        sweets() {
            return this.recipes.filter(
                (recipe) => recipe.recipe_category == "お菓子"
            );
        },

        recipeIngredient: {
            get() {
                return this.$store.getters.getRecipeIngredient;
            },
            set(val) {
                this.setRecipeIngredient(val);
            },
        },
    },
    mounted() {
        // console.log(this.categories);
    },
    methods: {
        showRecipeCategoryDetail(recipe_category_name, recipe_category_sub) {
            this.$router.push({
                name: "recipeCategoryDetailList",
                params: {
                    categoryName: recipe_category_name,
                    categoryPath: recipe_category_sub,
                },
            });
        },
        ...mapMutations([
            "setRecipeIngredient",
            "setRecipeIngredientList",
            "initRecipeIngredientList",
            "setIsEditingRecipeIngredient",
            "initIsEditingRecipeIngredient",
            "setEditingRecipeIngredientIndex",
            "initEditingRecipeIngredientIndex",
        ]),
        goToPreviousPage() {
            this.$router.back();
        },
    },
};
</script>
