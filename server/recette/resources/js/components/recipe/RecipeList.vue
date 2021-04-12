<template>
    <section class="section-recipelist">
        <div class="wrapper-recipelist">
            <ReturnButton :props-function="routerBack" />
            <h5>{{ listName }}</h5>
            <div class="container-recipe-recipelist">
                <!-- ↓レシピリスト -->
                <div
                    class="d-flex pt-4 pb-4 w-100"
                    style="border-bottom: 1px solid #c4c4c4"
                    v-for="recipe in recipeList"
                    :key="recipe.id"
                >
                    <img
                        class="element-recipe_image-recipelist mr-3"
                        :src="recipe.recipe_image_path"
                        alt="レシピリストのレシピ画像"
                    />

                    <!-- 右側 -->
                    <div class="w-100">
                        <!-- 縦方向のflex -->
                        <div class="d-flex flex-column h-100">
                            <div class="d-flex justify-content-between">
                                <h6>{{ recipe.recipe_name }}</h6>
                                <i
                                    @click="deleteRecipe(recipe.id)"
                                    class="fas fa-trash-alt font_size-sm cursor-pointer"
                                ></i>
                            </div>

                            <div class="small mb-0">
                                <p class="mb-1">
                                    {{ 1 }}.{{ recipe.recipe_procedure[0] }}...
                                </p>
                            </div>

                            <div
                                class="d-flex w-100 justify-content-between mt-auto"
                            >
                                <PrimaryButton
                                    :button-name="'詳細'"
                                    :button-style="
                                        style.showRecipeDetailButtonStyle
                                    "
                                    :props-function="showRecipeDetail"
                                    :recipe-id="recipe.id"
                                />

                                <PrimaryButton
                                    v-if="recipe.is_favorite == 1"
                                    :button-name="'お気に入り解除'"
                                    :button-style="style.addFavoriteButtonStyle"
                                    :is-favorite="recipe.is_favorite"
                                    :props-function="toggleFavorite"
                                    :recipe-id="recipe.id"
                                />
                                <PrimaryButton
                                    v-if="recipe.is_favorite == 0"
                                    :button-name="'お気に入り追加'"
                                    :button-style="style.addFavoriteButtonStyle"
                                    :is-favorite="recipe.is_favorite"
                                    :props-function="toggleFavorite"
                                    :recipe-id="recipe.id"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";
export default {
    components: { PrimaryButton, ReturnButton },
    mixins: [utilsMixin],
    name: "RecipeList",
    data() {
        return {
            listName: "",
            style: {
                addFavoriteButtonStyle: {
                    color: "#fff",
                    backgroundColor: "#E0D29E",
                    fontSize: "10px",
                    flexBasis: "65%",
                },

                showRecipeDetailButtonStyle: {
                    color: "#fff",
                    backgroundColor: "#B1C6BD",
                    fontSize: "10px",
                    flexBasis: "32%",
                },
            },
        };
    },
    computed: {
        recipeList() {
            switch (this.listName) {
                case "マイレシピ":
                    return this.recipes.filter(
                        (recipe) => recipe.user_id == this.userData.userId
                    );
                // break;
                case "新着レシピ":
                    const newArrivalRecipes = this.recipes.slice();
                    newArrivalRecipes.sort(
                        (a, b) =>
                            new Date(a.updated_at) - new Date(b.updated_at)
                    );
                    return newArrivalRecipes;
                // break;
                // seasonalRecipes
                default:
                    return this.recipes.filter(
                        (recipe) => recipe.user_id == this.userData.userId
                    );
                // break;
            }
        },
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
        }),
        listType() {
            const listType = window.location.pathname.split(
                "/recipes/list/"
            )[1];
            return listType;
        },
    },
    created() {
        this.listType == "my-recipes"
            ? (this.listName = "マイレシピ")
            : (this.listName = "新着レシピ");
    },
    methods: {
        ...mapActions(["setRecipes"]),
        deleteRecipe(recipeId) {
            const boolConfirmDeleteRecipe = confirm(
                "このレシピを削除してよろしいですか？"
            );
            if (boolConfirmDeleteRecipe == true) {
                const url =
                    "/api/users/" +
                    this.userData.userId +
                    "/recipes/" +
                    recipeId +
                    "/delete";
                axios
                    .delete(url)
                    .then((res) => {
                        this.setRecipes(res.data);
                        this.$router.push({ name: "myRecipes" });
                    })
                    .catch((error) => {});
            }
        },
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: { recipeId: recipeId },
            });
        },
        toggleFavorite(recipeId, isFavorite) {
            let url =
                "/api/users/" +
                this.userData.userId +
                "/recipes/" +
                recipeId +
                "/favorite";
            if (isFavorite == 1) {
                url = url + "/remove";
            } else {
                url = url + "/add";
            }
            axios
                .post(url)
                .then((res) => {
                    this.setRecipes(res.data);
                })
                .catch(function (error) {});
        },
    },
};
</script>
