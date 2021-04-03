<template>
    <div class="recipe_wrapper-top">
        <div class="recipe_container-top">
            <div class="upper_content-top mb-2">
                <h4>Reccete</h4>
                <!-- ユーザーアイコン -->

                <span
                    class="dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="fas fa-user-circle fa-2x"></i>
                </span>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <router-link
                        :to="{
                            name: 'myPage',
                        }"
                        class="dropdown-item"
                    >
                        マイページ
                    </router-link>
                    <a @click.prevent="logout" class="dropdown-item" href="#"
                        >ログアウト</a
                    >
                </div>
            </div>
            <!-- 検索フォーム -->
            <SearchWindow />
            <!-- <VueSimpleSuggest
                v-model="chosen"
                :list="simpleSuggestionList"
                :filter-by-query="true"
            /> -->
            <!-- Filter by input text to only show the matching results -->

            <!-- マイレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-4"
            >
                <h5>マイレシピ</h5>

                <router-link
                    class="small"
                    :to="{
                        name: 'recipeList',
                        params: {
                            listName: 'マイレシピ',
                            listType: ' myRecipes',
                        },
                    }"
                >
                    すべて見る ＞
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

                    <p class="small">{{ recipe.recipe_name }}</p>
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
                <h5>新着レシピ</h5>
                <router-link
                    class="small"
                    :to="{
                        name: 'recipeList',
                        params: {
                            listName: '新着レシピ',
                            listType: ' newArrivalRecipes',
                        },
                    }"
                >
                    すべて見る ＞
                </router-link>
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

                    <p class="small">{{ recipe.recipe_name }}</p>
                    <!-- <form action="" method="get" name="testForm"></form> -->
                </div>
            </div>
            <!-- 旬のレシピ -->
            <div
                class="top-container-recipe-title d-flex justify-content-between mt-5"
            >
                <h4>旬のレシピ</h4>
                <router-link
                    class="small"
                    :to="{
                        name: 'recipeList',
                        params: {
                            listName: '旬のレシピ',
                            listType: ' seasonalRecipes',
                        },
                    }"
                >
                    すべて見る ＞
                </router-link>
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

                    <p class="small">{{ recipe.recipe_name }}</p>
                    <!-- <form action="" method="get" name="testForm"></form> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import SearchWindow from "./parts/SearchWindow";
import VueSimpleSuggest from "vue-simple-suggest";
import "vue-simple-suggest/dist/styles.css"; // Optional CSS
export default {
    name: "Top",
    components: {
        SearchWindow,
        VueSimpleSuggest,
    },
    props: [],
    data() {
        return {
            chosen: "",
            recipeName: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            user: null,
            // userId: document
            //     .querySelector('meta[name="user-id"]')
            //     .getAttribute("content"),
        };
    },
    created() {
        this.fetchAllRecipes();
        this.fetchAllIngredients();
    },
    mounted() {
        axios.get("api/user").then((res) => {
            this.user = res.data;
            this.setUserData(res.data);
        });
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            userId: "getUserId",
            recipes: "getRecipes",
            ingredients: "getIngredients",
        }),
    },
    methods: {
        simpleSuggestionList() {
            [
                { id: 1, firstName: "タロウ", lastName: "サトウ" },
                { id: 2, firstName: "ジロウ", lastName: "イノウエ" },
                { id: 3, firstName: "サブロウ", lastName: "タナカ" },
            ];
        },
        ...mapMutations([
            "setRecipes",
            "initRecipes",
            "setUserData",
            "setIngredients",
            "initIngredients",
        ]),
        fetchAllRecipes: async function () {
            await axios
                .get("/api/recipes/")
                .then((response) => {
                    this.setRecipes(response.data);
                    console.log(this.recipes);
                })
                .catch((error) => {});
        },
        fetchAllIngredients: async function () {
            await axios
                .get("/api/users/" + this.userId + "/ingredients/")
                .then((response) => {
                    this.setIngredients(response.data);
                    console.log(this.ingredients);
                })
                .catch((error) => {});
        },
        logout() {
            axios.post("/api/logout").then(() => {
                this.$router.push("/login");
            });
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
