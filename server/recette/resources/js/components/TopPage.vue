<template>
    <div class="recipe_wrapper-top">
        <div class="recipe_container-top">
            <div class="upper_content-top">
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
                <router-link
                    :to="{
                        name: 'myRecipes',
                        params: {
                            listType: 'マイレシピ',
                        },
                    }"
                >
                    すべて見る
                </router-link>
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
import { mapGetters, mapMutations } from "vuex";
export default {
    name: "Top",
    props: ["", "ingredients"],
    data() {
        return {
            recipeName: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            userId: document
                .querySelector('meta[name="user-id"]')
                .getAttribute("content"),
        };
    },
    created() {
        this.fetchAllRecipes();
        this.$store.commit("setUserId", this.userId);
    },
    mounted() {
        console.log(this.userId);
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
        }),
    },
    methods: {
        ...mapMutations(["setRecipes", "initRecipes"]),
        fetchAllRecipes: async function () {
            await axios
                .get("/api/recipes/")
                .then((response) => {
                    this.setRecipes(response.data);
                    console.log(this.recipes);
                })
                .catch((error) => {});
        },
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: { recipeId: recipeId },
            });
        },

        addInitDatatoIngredientsTable() {
            console.log(this.initialIngredientList);
        },
    },
};
</script>
