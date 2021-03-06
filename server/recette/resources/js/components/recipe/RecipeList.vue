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
                <h3>{{ "〇〇レシピ一覧" }}</h3>
            </div>
            <div class="mx-auto" style="max-width: 500px">
                <div
                    class="d-flex pt-4 pb-4 align-items-center;"
                    style="
                        border-bottom: 1px solid #c4c4c4;
                        position: relative;
                        z-index: 1;
                    "
                    v-for="recipe in recipes"
                    :key="recipe.id"
                >
                    <img
                        class="recipe_image mr-3"
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
                        <PrimaryButton
                            :buttonName="'詳細を見る'"
                            :propsFunc="showRecipeDetail"
                            :recipeId="recipe.id"
                        />
                    </div>
                </div>
            </div>
        </form>
        <!-- ピックアップレシピ -->
    </div>
</template>

<script>
import PrimaryButton from "../parts/PrimaryButton";
export default {
    name: "RecipeList",
    components: { PrimaryButton },
    props: ["userId", "recipes", "ingredients"],
    data() {
        return {
            recipeName: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {
        console.log(location.pathname.split("/users/")[1]);
        this.$store.commit("setUserId", this.userId);
    },
    mounted() {},
    methods: {
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
    },
};
</script>
