<template>
    <section class="section-recipelist">
        <div class="wrapper-recipelist">
            <ReturnButton :props-function="routerBack" />
            <!-- 
            <BreadCrumb
                class="breadcrumb-component"
                :bread-crumb-list="breadCrumbList"
                :paramsType="'listType'"
                :params="listType"
            /> -->

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
                                    class="fas fa-trash-alt"
                                ></i>
                            </div>

                            <div class="small mb-0">
                                <p class="mb-1">
                                    {{ 1 }}.{{ recipe.recipe_procedure[0] }}
                                </p>
                            </div>

                            <div
                                class="d-flex w-100 justify-content-between mt-auto"
                            >
                                <PrimaryButton
                                    :buttonName="'詳細'"
                                    :buttonStyle="showRecipeDetailButtonStyle"
                                    :propsFunction="showRecipeDetail"
                                    :recipe-id="recipe.id"
                                />

                                <PrimaryButton
                                    v-if="recipe.is_favorite == 1"
                                    :icon="icon"
                                    :buttonName="'お気に入り解除'"
                                    :buttonStyle="addFavoriteButtonStyle"
                                    :props-function="toggleFavorite"
                                    :recipe-id="recipe.id"
                                    :isFavorite="recipe.is_favorite"
                                />
                                <PrimaryButton
                                    v-if="recipe.is_favorite == 0"
                                    :icon="icon"
                                    :buttonName="'お気に入り追加'"
                                    :buttonStyle="addFavoriteButtonStyle"
                                    :props-function="toggleFavorite"
                                    :recipe-id="recipe.id"
                                    :isFavorite="recipe.is_favorite"
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
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import ReturnButton from "../parts/ReturnButton";
import BreadCrumb from "../common/BreadcrumbTrail";
import utilsMixin from "../../mixin/utility";
export default {
    name: "RecipeList",
    components: { PrimaryButton, BreadCrumb, ReturnButton },
    mixins: [utilsMixin],
    props: [],
    data() {
        return {
            listName: "",
            // icon: "fas fa-heart",
            showRecipeDetailButtonStyle: {
                color: "#fff",
                backgroundColor: "#B1C6BD",
                fontSize: "10px",
                flexBasis: "32%",
            },
            addFavoriteButtonStyle: {
                color: "#fff",
                backgroundColor: "#E0D29E",
                fontSize: "10px",
                flexBasis: "65%",
            },
        };
    },
    computed: {
        recipeList() {
            switch (this.listName) {
                case "マイレシピ":
                    return this.recipes.filter(
                        (recipe) => recipe.user_id == this.userId
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
                        (recipe) => recipe.user_id == this.userId
                    );
                // break;
            }
        },
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
        }),
        listType() {
            const listType = window.location.pathname.split(
                "/recipes/list/"
            )[1];
            return listType;
        },
        breadCrumbList() {
            return [
                {
                    id: 1,
                    name: "ホーム",
                    linkName: "recipes",
                },
                {
                    id: 2,
                    name: this.listName,
                    linkName: "recipeList",
                },
            ];
        },
    },
    created() {},
    mounted() {
        this.listType == "my-recipes"
            ? (this.listName = "マイレシピ")
            : (this.listName = "新着レシピ");
    },
    methods: {
        ...mapMutations(["setRecipes", "initRecipes"]),
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: { recipeId: recipeId },
            });
        },
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function (recipeId) {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            // const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            location.pathname =
                "/users/" +
                this.$store.state.userId +
                "/recipes/" +
                "edit/" +
                recipeId;
        },
        deleteRecipe(recipeId) {
            const deleteCheckResult = confirm(
                "このレシピを削除してよろしいですか？"
            );
            if (deleteCheckResult == true) {
                const url =
                    "/api/users/" +
                    this.userId +
                    "/recipes/" +
                    recipeId +
                    "/delete";
                axios
                    .delete(url)
                    .then((res) => {
                        this.$router.push({ name: "myRecipes" });
                        this.setRecipes(res.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        toggleFavorite(recipeId, isFavorite) {
            let url =
                "/api/users/" +
                this.userId +
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
                    console.log(res);
                    this.setRecipes(res.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
};
</script>
