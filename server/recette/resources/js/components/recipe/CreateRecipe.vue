<template>
    <section class="recipe-detail-section">
        <p>レシピ新規登録画面</p>
        <i
            @click="returnToPreviousPage()"
            class="fas fa-long-arrow-alt-left fa-2x"
        ></i>

        <form
            action=""
            method="POST"
            enctype="multipart/form-data"
            id="create-recipe-form"
            name="createRecipeForm"
        >
            <input type="hidden" name="_token" :value="csrf" />
            <div class="meal-container__recipe-deatail">
                <ImagePreview />
            </div>
            <div class="ingredient-container__recipe-deatail">
                <p class="ingredient-title__recipe-detail">材料</p>
                <div class="ingredient-description__recipe-deatail">
                    <div class="form-group">
                        <label class="d-block p-1" for="imagefile"
                            >レシピ名：</label
                        >
                        <input
                            class="d-block p-1 form-control"
                            type="text"
                            id="recipe-name"
                            name="recipe_name"
                            v-model="recipeName"
                        />
                        <label class="d-block p-1" for="price">価格：</label>
                        <input
                            class="d-block p-1 form-control"
                            type="text"
                            id="price"
                            name="reprice"
                            size="50"
                            value=""
                        />
                        <label class="d-block p-1" for="stock-quantity"
                            >在庫数：</label
                        >
                    </div>
                </div>
            </div>
            <div class="recipe-container__recipe-deatail">
                <p class="recipe-title__recipe-detail">作り方</p>
                <div class="recipe-description__recipe-deatail">
                    作り方が表示される
                </div>
            </div>
            <button
                @click="showRecipeDetail()"
                style="
                    width: 100%;
                    border-radius: 10%;
                    color: FFFFFF;
                    background-color: E4C8AD;
                "
            >
                登録する
            </button>
        </form>
    </section>
</template>

<script>
import Button from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button.vue";
import ImagePreview from "../parts/ImagePreview";

export default {
    name: "CreateRecipe",
    components: {
        ImagePreview,
    },
    data() {
        return {
            recipeName: "eee",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {
        console.log("create");
    },
    methods: {
        showRecipeDetail: function () {
            const recipeId = 364;
            const userId = this.$store.state.userId;
            document.createRecipeForm.action = `/users/${userId}/recipes/store`;
            document.createRecipeForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            console.log(recipeId);

            location.pathname =
                "/users/" +
                this.$store.state.userId +
                "/recipes/" +
                "edit/" +
                recipeId;

            // location.pathname = `/users/${this.$store.state.userId} + "/" + recipeId`;
            // const recipeId = 364;
            // document.testForm.action = `/user/1/recipes/${recipeId}`;
            // document.testForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
    },
};
</script>
