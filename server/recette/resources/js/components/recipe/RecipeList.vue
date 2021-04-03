<template>
    <div class="top-container container">
        <router-link
            :to="{
                name: 'recipes',
            }"
        >
            <i class="fas fa-angle-left fa-2x"></i>
        </router-link>
        <!-- マイレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h3>{{ listName }}</h3>
        </div>
        <div class="mx-auto" style="max-width: 500px">
            <div
                class="d-flex pt-4 pb-4 align-items-center;"
                style="
                    border-bottom: 1px solid #c4c4c4;
                    position: relative;
                    z-index: 1;
                "
                v-for="recipe in recipeList"
                :key="recipe.id"
            >
                <img
                    class="recipe-image__recipe-list mr-3"
                    :src="recipe.recipe_image_path"
                    alt=""
                />

                <div>
                    <!-- <div class="text-right" style="">
                        <span class="" @click="goToRecipeEditScreen(recipe.id)"
                            ><i class="fas fa-pencil-alt mr-1"></i>編集</span
                        >
                    </div> -->
                    <div class="d-flex justify-content-between">
                        <h4>{{ recipe.recipe_name }}</h4>

                        <i
                            @click="deleteRecipe(recipe.id)"
                            class="fas fa-trash-alt"
                        ></i>
                    </div>
                    <div
                        v-for="(
                            recipe_procedure, index
                        ) in recipe.recipe_procedure"
                        :key="recipe_procedure"
                    >
                        <span class="small">
                            {{ index + 1 }}.{{ recipe_procedure }}
                        </span>
                    </div>

                    <div class="d-flex w-100">
                        <PrimaryButton
                            :buttonName="'詳細'"
                            :buttonStyle="showRecipeDetailButtonStyle"
                            :propsFunction="showRecipeDetail"
                            :recipe-id="recipe.id"
                            class="mr-2"
                        />

                        <PrimaryButton
                            v-if="recipe.is_favorite == true"
                            :icon="icon"
                            :buttonName="'お気に入り解除'"
                            :buttonStyle="addFavoriteButtonStyle"
                            :props-function="toggleFavorite"
                            :recipe-id="recipe.id"
                        />
                        <PrimaryButton
                            v-if="recipe.is_favorite == false"
                            :icon="icon"
                            :buttonName="'お気に入り追加'"
                            :buttonStyle="addFavoriteButtonStyle"
                            :props-function="toggleFavorite"
                            :recipe-id="recipe.id"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- ピックアップレシピ -->
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
export default {
    name: "RecipeList",
    components: { PrimaryButton },
    props: ["ingredients", "listName", "listType"],
    data() {
        return {
            icon: "fas fa-heart",
            recipeName: "",
            showRecipeDetailButtonStyle: {
                color: "#fff",
                backgroundColor: "#B1C6BD",
                fontSize: "10px",
                flexBasis: "30%",
            },
            addFavoriteButtonStyle: {
                color: "#fff",
                backgroundColor: "#E0D29E",
                fontSize: "10px",
                flexBasis: "70%",
            },
            buttonName: "お気に入り追加",
            isFavorite: false,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        recipeList() {
            switch (this.listType) {
                case "myRecipes":
                    return this.recipes.filter(
                        (recipe) => recipe.user_id == this.userId
                    );
                // break;

                case "newArrivalRecipes":
                    return this.recipes.filter(
                        (recipe) => recipe.user_id == this.userId
                    );
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
    },
    created() {},
    mounted() {
        console.log(this.recipeList);
    },
    methods: {
        ...mapMutations(["setRecipes", "initRecipes"]),
        showRecipeDetail(recipeId) {
            console.log(recipeId);
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
        toggleFavorite(recipeId) {
            this.isFavorite = !this.isFavorite;
            let url =
                "/api/users/" +
                this.userId +
                "/recipes/" +
                recipeId +
                "/favorite";

            if (this.isFavorite == true) {
                this.buttonName = "お気に入り解除";
                url = url + "/add";
            } else {
                this.buttonName = "お気に入り追加";
                url = url + "/remove";
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
