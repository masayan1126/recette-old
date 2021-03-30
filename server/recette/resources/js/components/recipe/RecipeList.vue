<template>
    <div class="top-container container">
        <form
            action=""
            method=""
            enctype="multipart/form-data"
            id="recipe-list-form"
            name="recipeListForm"
        >
            <input type="hidden" name="_token" :value="csrf" />
            <i
                @click="returnToPreviousPage()"
                class="fas fa-long-arrow-alt-left fa-2x"
            ></i>
            <!-- マイレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-5"
            >
                <h3>{{ listType }}</h3>
            </div>
            <div class="mx-auto" style="max-width: 500px">
                <div
                    class="d-flex pt-4 pb-4 align-items-center;"
                    style="
                        border-bottom: 1px solid #c4c4c4;
                        position: relative;
                        z-index: 1;
                    "
                    v-for="recipe in myRecipes"
                    :key="recipe.id"
                >
                    <img
                        class="recipe-image__recipe-list mr-3"
                        :src="recipe.recipe_image_path"
                        alt=""
                    />

                    <div style="position: relative; z-index: 2">
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
                        <p>作り方が表示されるあああaaaaaaaaaaaaaaaa</p>
                        <div class="d-flex w-100">
                            <PrimaryButton
                                :buttonName="'詳細'"
                                :buttonStyle="showRecipeDetailButtonStyle"
                                :propsFunc="showRecipeDetail"
                                :recipeId="recipe.id"
                                class="mr-2"
                            />
                            <PrimaryButton
                                :icon="icon"
                                :buttonName="buttonName"
                                :buttonStyle="addFavoriteButtonStyle"
                                :propsFunc="toggleFavorite"
                                :recipeId="recipe.id"
                                :isFavorite="recipe.is_favorite"
                            />
                            <!-- <PrimaryButton
                                v-else
                                :buttonName="buttonName"
                                :buttonStyle="addFavoriteButtonStyle"
                                :propsFunc="removeFavorite"
                                :recipeId="recipe.id"
                            /> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- ピックアップレシピ -->
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
export default {
    name: "RecipeList",
    components: { PrimaryButton },
    props: ["ingredients", "listType", ""],
    data() {
        return {
            icon: "far fa-heart",
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
            buttonName: "お気に入りに追加",
            isFavorite: false,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        myRecipes() {
            return this.recipes.filter(
                (recipe) => recipe.user_id == this.userId
            );
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
        showRecipeDetail: function (recipeId) {
            document.recipeListForm.method = "GET";
            document.recipeListForm.action = `/users/${this.$store.state.userId}/recipes/${recipeId}`;
            console.log(document.recipeListForm.action);
            document.recipeListForm.submit();
        },
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function (recipeId) {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            // const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            console.log(recipeId);

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

            const userId = this.$store.state.userId;
            document.recipeListForm.action = `/users/${userId}/recipes/delete/${recipeId}`;
            document.recipeListForm.method = "POST";
            console.log(document.recipeListForm);
            deleteCheckResult == true ? document.recipeListForm.submit() : "";
        },
        toggleFavorite(recipeId, isFavorite) {
            let url = "";
            this.isFavorite = !this.isFavorite;
            console.log(this.isFavorite);
            if (this.isFavorite == true) {
                this.buttonName = "お気に入り解除";
                url =
                    "/api/users/" +
                    this.$store.state.userId +
                    "/recipes/" +
                    recipeId +
                    "/add/favorite";
            } else {
                this.buttonName = "お気に入り追加";
                url =
                    "/api/users/" +
                    this.$store.state.userId +
                    "/recipes/" +
                    recipeId +
                    "/remove/favorite";
            }

            axios
                .post(url)
                .then((res) => {
                    console.log(res);
                })
                .catch(function (error) {
                    console.log(error);
                });

            // if (isFavorite == 1) {
            //     console.log(isFavorite);
            //     url =
            //         "/api/users/" +
            //         this.$store.state.userId +
            //         "/recipes/" +
            //         recipeId +
            //         "/remove/favorite";

            //     this.buttonName = "お気に入りに追加";
            // } else {
            //     url =
            //         "/api/users/" +
            //         this.$store.state.userId +
            //         "/recipes/" +
            //         recipeId +
            //         "/add/favorite";
            // }

            // console.log(url);
        },
        // removeFavorite(recipeId) {
        //     this.buttonName = "お気に入りに追加";
        //     console.log(recipeId);
        //     axios
        //         .post(
        //             "/api/users/" +
        //                 this.$store.state.userId +
        //                 "/recipes/" +
        //                 recipeId +
        //                 "/remove/favorite"
        //         )
        //         .catch(function (error) {
        //             console.log(error);
        //         });
        // },
    },
};
</script>
