<template>
    <section class="section-favorite_recipe">
        <div class="wrapper-favorite_recipe">
            <router-link :to="{ name: 'recipes' }"
                ><i class="fas fa-angle-left fa-2x"></i
            ></router-link>
            <hr />
            <h5>お気に入りレシピ</h5>
            <div class="container-favorite_recipe mb-4 d-flex">
                <div class="area-favorite_recipe">
                    <div
                        v-for="favoriteRecipe in favoriteRecipes"
                        :key="favoriteRecipe.id"
                    >
                        <img
                            class="w-100"
                            :src="favoriteRecipe.recipe_image_path"
                            alt=""
                        />
                        <p>{{ favoriteRecipe.recipe_name }}</p>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
export default {
    name: "FavoriteRecipeList",
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
        favoriteRecipes() {
            return this.recipes.filter((recipe) => recipe.is_favorite == 1);
        },
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
        }),
    },
    created() {},
    mounted() {
        console.log(this.recipes);
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
