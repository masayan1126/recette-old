<template>
    <div class="recipe_wrapper-top">
        <div class="recipe_container-top">
            <div class="upper_content-top">
                <button @click="addInitDatatoIngredientsTable()"></button>
                <!-- 検索フォーム -->

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"
                            >@</span
                        >
                    </div>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Username"
                        aria-label="Username"
                        aria-describedby="basic-addon1"
                    />
                </div>

                <!-- ユーザーアイコン -->
                <i class="far fa-user-circle fa-2x"></i>
            </div>
            <!-- マイレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-5"
            >
                <h3>マイレシピ</h3>
                <p @click="showRecipeList()">すべて見る</p>
            </div>
            <div class="top-container-recipe-content" v-if="recipes.length > 0">
                <div
                    class="recipe"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in recipes"
                    :key="recipe.id"
                >
                    <img
                        class="recipe_image__top"
                        :src="recipe.recipe_image_path"
                        alt="マイレシピ画像"
                    />

                    <p>{{ recipe.recipe_name }}</p>
                    <!-- <form action="" method="get" name="testForm"></form> -->
                </div>
            </div>
            <div v-else class="top-container-recipe-content mt-2">
                <p>
                    <i class="fas fa-exclamation-circle mr-2"></i
                    >データがまだありません。<br />レシピ追加からレシピを登録してみましょう!
                </p>
                <!-- <p></p> -->
            </div>
            <!-- ピックアップレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-5"
            >
                <h3>おすすめレシピ</h3>
                <p>すべて見る</p>
            </div>
            <div class="top-container-recipe-content">
                <div
                    class="recipe"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in recipes"
                    :key="recipe.id"
                >
                    <img
                        class="recipe_image__top"
                        :src="recipe.recipe_image_path"
                        alt=""
                    />

                    <p>{{ recipe.recipe_name }}</p>
                    <!-- <form action="" method="get" name="testForm"></form> -->
                </div>
            </div>
            <!-- 旬のレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-5"
            >
                <h3>旬のレシピ</h3>
                <p>すべて見る</p>
            </div>
            <div class="top-container-recipe-content">
                <div
                    class="recipe"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in recipes"
                    :key="recipe.id"
                >
                    <img
                        class="recipe_image__top"
                        :src="recipe.recipe_image_path"
                        alt=""
                    />

                    <p>{{ recipe.recipe_name }}</p>
                    <!-- <form action="" method="get" name="testForm"></form> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import initialIngredientList from "../assets/initialIngredientList.json";

export default {
    name: "Top",
    props: ["userId", "recipes", "ingredients"],
    data() {
        return {
            initialIngredientList: initialIngredientList,
            recipeName: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {
        this.$store.commit("setUserId", this.userId);
        if (this.ingredients.length == 0) {
            axios
                .post(
                    "/api/users/" +
                        this.$store.state.userId +
                        "/ingredients/add",
                    {
                        initialIngredientList: JSON.stringify(
                            this.initialIngredientList
                        ),
                    }
                )
                .catch(function (error) {
                    console.log(error);
                });
        }
        console.log(location.pathname.split("/users/")[1]);
    },
    mounted() {
        console.log(this.ingredients);
    },
    methods: {
        showRecipeDetail: function (recipeId) {
            location.pathname = location.pathname + "/" + recipeId;
        },
        showRecipeList() {
            location.pathname =
                "/users/" + this.$store.state.userId + "/recipes/list";
        },
        addInitDatatoIngredientsTable() {
            console.log(this.initialIngredientList);
        },
    },
};
</script>
