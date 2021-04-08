<template>
    <section class="section-recipe_category_detail_list">
        <div class="wrapper-recipe_category_detail_list">
            <ReturnButton :props-function="routerBack" />
            <!-- ぱんくずリスト -->
            <!-- <BreadCrumb class="breadcrumb-component" /> -->

            <div class="mb-4 mt-4">
                <h5>
                    カテゴリーから探す/
                    <span class="small">{{
                        selectedRecipeCategoryList[0].recipe_category
                    }}</span>
                </h5>
                <div class="container-recipe_category_detail_list mt-4">
                    <ul
                        class="d-flex justify-content-between align-items-center w-100"
                        style="border-bottom: 1px solid #c4c4c4"
                        v-for="selectedRecipe in selectedRecipeCategoryList"
                        :key="selectedRecipe.id"
                        @click.prevent="
                            showRecipeCategoryDetail(selectedRecipe.id)
                        "
                    >
                        <li
                            class="d-flex justify-content-between align-items-center py-2"
                        >
                            <div>
                                <img
                                    :src="selectedRecipe.recipe_image_path"
                                    alt="選択されたカテゴリーのレシピ画像"
                                    class="element-category_image-recipe_category_detail_list"
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
import { mapGetters, mapMutations } from "vuex";
import BreadCrumb from "../common/BreadcrumbTrail";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";

export default {
    name: "RecipeCategoryDetailList",
    props: ["categoryName"],
    mixins: [utilsMixin],
    components: { BreadCrumb, ReturnButton },
    data() {
        return {
            // 初期データの食材リスト登録状況に応じてトーストの表示を切り替えるためのフラグ
        };
    },
    computed: {
        selectedRecipeCategoryList() {
            const id = window.location.pathname.split("/recipes/category/")[1];
            return this.recipes.filter(
                (recipe) => recipe.recipe_category_sub == id
            );
        },
        ...mapGetters({
            recipes: "getRecipes",
            userData: "getData",
            recipeIngredientList: "getRecipeIngredientList",
            isEditingIngredient: "getIsEditingRecipeIngredient",
            editingIngredientIndex: "getEditingRecipeIngredientIndex",
        }),
    },
    mounted() {
        const id = window.location.pathname.split("/recipes/category/")[1];
        this.selectedCategoryName = this.categoryName;
        console.log(this.selectedRecipeCategoryList);
    },
    methods: {
        showRecipeCategoryDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: {
                    recipeId: recipeId,
                },
            });
        },
        ...mapMutations([]),
        goToPreviousPage() {
            this.$router.back();
        },
    },
};
</script>
