<template>
    <section class="section-recipe_search">
        <div class="wrapper-recipe_search">
            <i @click="goToPreviousPage" class="fas fa-angle-left fa-2x"></i>

            <div class="container-recipe_search mb-4 mt-4">
                <h4>カテゴリーから探す/{{}}</h4>
                <div class="area-recipe_search mt-4">
                    <form
                        action=""
                        method="get"
                        enctype="multipart/form-data"
                        name="showRecipeCategoryDetailForm"
                    >
                        <input type="hidden" name="_token" :value="csrf" />
                        <input
                            type="hidden"
                            name="selectedRecipeCategory"
                            :value="JSON.stringify(selectedRecipeCategoryList)"
                        />
                        <div
                            class="d-flex justify-content-between align-items-center"
                            v-for="category in categories"
                            :key="category.id"
                        >
                            <ul>
                                <li class="d-flex justify-content-start">
                                    <img
                                        :src="''"
                                        alt=""
                                        style="width: 50px; height: 50px"
                                    />
                                    {{ category.recipe_category_name }}
                                </li>
                            </ul>
                            <span>{{ 1 }}</span>
                        </div>
                        <hr />
                    </form>
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

export default {
    name: "RecipeCategoryList",
    props: ["recipes"],
    components: {
        ImagePreview,
        PrimaryButton,
        TextInput,
        InputLabel,
    },
    data() {
        return {
            // 初期データの食材リスト登録状況に応じてトーストの表示を切り替えるためのフラグ
            sendNewRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
            selectedRecipeCategoryList: [],

            categories: [
                {
                    id: 1,
                    recipe_category_name: "肉料理",
                    recipe_category_sub: "meat",
                    recipe_category_image: "/images/肉料理.jpeg",
                    length: 0,
                },
                {
                    id: 2,
                    recipe_category_name: "魚料理",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 3,
                    recipe_category_name: "野菜料理",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 4,
                    recipe_category_name: "麺類",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 5,
                    recipe_category_name: "ご飯もの",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 6,
                    recipe_category_name: "スープ、汁物",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 7,
                    recipe_category_name: "パン類",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 8,
                    recipe_category_name: "お菓子",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 9,
                    recipe_category_name: "そのほか",
                    recipe_category_image: "",
                    length: 0,
                },
            ],
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
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
        console.log(this.recipes);
    },
    methods: {
        showRecipeCategoryDetail(url, recipeCategory) {
            this.selectedRecipeCategoryList.push(recipeCategory);
            console.log(this.selectedRecipeCategoryList);
            document.showRecipeCategoryDetailForm.action =
                "/users/" + this.userId + "/recipes/category/" + url;
            console.log(document.showRecipeCategoryDetailForm);
            document.showRecipeCategoryDetailForm.submit();
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
        sendNewRecipe() {
            if (this.recipeName == "") {
                alert("レシピ名は必須です");
                return;
            }
            this.initRecipeIngredientList();
            document.createRecipeForm.action = `/users/${this.userId}/recipes/store`;
            document.createRecipeForm.submit();
        },
        goToPreviousPage() {
            this.$store.commit(
                "goToPreviousPage",
                `/users/${this.userId}/recipes`
            );
        },
    },
};
</script>
