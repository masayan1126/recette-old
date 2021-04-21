<template>
    <section class="section-toppage">
        <div class="wrapper-toppage">
            <div class="container-header_content-toppage mb-2">
                <h4>Reccete</h4>
                <!-- ユーザーメニュー(スマートフォン) -->

                <img
                    class="text-right w-10"
                    data-toggle="dropdown"
                    alt="ユーザープロフィール画像"
                    :src="userData.profileImagePath"
                />

                <div class="dropdown-menu">
                    <router-link
                        :to="{
                            name: 'myPage',
                        }"
                        class="dropdown-item"
                    >
                        マイページ
                    </router-link>
                    <a @click="logout" class="dropdown-item" href=""
                        >ログアウト</a
                    >
                </div>
            </div>
            <div class="container-header_content-toppage-sm">
                <!-- 検索フォーム -->
                <SearchWindow
                    :class-name="'search-window_toppage'"
                    :placeholder="'キーワードを入力しEnterを押してください'"
                    :props-function="searchRecipe"
                />

                <div class="user_menu-sm">
                    <!-- ユーザーメニュー(タブレット以上) -->

                    <img
                        class="w-30"
                        data-toggle="dropdown"
                        :src="userData.profileImagePath"
                        alt="ユーザープロフィール画像"
                    />

                    <div class="dropdown-menu">
                        <router-link
                            :to="{
                                name: 'myPage',
                            }"
                            class="dropdown-item"
                        >
                            マイページ
                        </router-link>
                        <a @click="logout" class="dropdown-item" href=""
                            >ログアウト</a
                        >
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <h5>マイレシピ</h5>
                <router-link
                    class="small"
                    :to="{
                        name: 'recipeList',
                        params: {
                            listType: 'my-recipes',
                        },
                    }"
                >
                    すべて見る ＞
                </router-link>
            </div>

            <!-- マイレシピが1つ以上登録されている場合はリストを表示する -->
            <div
                class="container-myrecipe-toppage mb-sm-4"
                v-if="myRecipes.length > 0"
            >
                <div
                    class="element-recipe-toppage"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in myRecipes"
                    :key="recipe.id"
                >
                    <img
                        class="element-recipe_image-toppage"
                        :src="recipe.recipe_image_path"
                        alt="マイレシピ画像"
                    />

                    <p class="small">{{ recipe.recipe_name }}</p>
                </div>
            </div>
            <div v-else class="container-myrecipe-toppage">
                <p>
                    <i class="fas fa-exclamation-circle mr-2"></i
                    >データがまだありません。<br />レシピ追加からレシピを登録してみましょう!
                </p>
            </div>

            <!-- 新着レシピ -->
            <div class="d-flex justify-content-between mt-4">
                <h5>新着レシピ</h5>
                <router-link
                    class="small"
                    :to="{
                        name: 'recipeList',
                        params: {
                            listType: 'new-arrival-recipes',
                        },
                    }"
                >
                    すべて見る ＞
                </router-link>
            </div>
            <div class="container-new_arrival_recipe-toppage mb-sm-4">
                <div
                    class="element-recipe-toppage"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in newArrivalRecipes"
                    :key="recipe.id"
                >
                    <img
                        class="element-recipe_image-toppage"
                        :src="recipe.recipe_image_path"
                        alt="新着レシピ画像"
                    />

                    <p class="small">{{ recipe.recipe_name }}</p>
                </div>
            </div>

            <!-- 旬のレシピ -->
            <div class="mt-4">
                <h5>旬のレシピ</h5>
            </div>
            <div class="container-seasonal_recipe-toppage d-flex w-100 mb-sm-5">
                <div
                    class="cursor-pointer element-seasonal_recipe_image-toppage"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in newArrivalRecipes"
                    :key="recipe.id"
                >
                    <img
                        class="w-100"
                        :src="recipe.recipe_image_path"
                        alt="旬のレシピ画像"
                    />

                    <p>{{ recipe.recipe_name }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import SearchWindow from "./parts/SearchWindow";

export default {
    components: {
        SearchWindow,
    },
    name: "TopPage",
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
        }),
        myRecipes() {
            return this.recipes.filter(
                (recipe) => recipe.user_id == this.userData.userId
            );
        },
        newArrivalRecipes() {
            // 非破壊コピーして日付の昇順にソート
            const newArrivalRecipes = this.recipes.slice();
            newArrivalRecipes.sort(
                (a, b) => new Date(b.updated_at) - new Date(a.updated_at)
            );
            return newArrivalRecipes;
        },
    },
    created() {
        this.fetchAllRecipes();
        this.fetchUserIngredients();
        axios.get("api/user").then((res) => {
            this.setUserData(res.data);
        });
        // apiから取得した認証情報をstoreにセット
    },
    methods: {
        simpleSuggestionList() {
            return ["Vue.js", "React.js", "Angular.js"];
        },
        ...mapActions([
            "setRecipes",
            "setUserData",
            "setIngredients",
            "initUserData",
        ]),

        // ログインしているユーザーにかかわらず、全てのレシピを取得
        fetchAllRecipes: async function () {
            await axios
                .get("/api/recipes")
                .then((response) => {
                    this.setRecipes(response.data);
                })
                .catch((error) => {});
        },
        // ログインしているユーザーの食材データのみ取得
        fetchUserIngredients: async function () {
            await axios
                .get("/api/users/" + this.userData.userId + "/ingredients")
                .then((response) => {
                    const ingredients = [];
                    response.data.forEach((ingredient) => {
                        const _ingredient = {
                            ingredient_name: ingredient.ingredient_name,
                            ingredient_category: ingredient.ingredient_category,
                        };
                        ingredients.push(_ingredient);
                    });

                    this.setIngredients(ingredients);
                })
                .catch((error) => {});
        },
        logout() {
            axios.post("/api/logout").then((res) => {
                this.initUserData();
            });
        },
        searchRecipe(e) {
            if (e.target.value == "") {
                alert("キーワードを入力して下さい");
                return;
            }
            this.$router.push({
                name: "recipeList",
                params: {
                    listType: "search-result-recipe",
                },
                query: { query: e.target.value },
            });
        },
        showRecipeDetail(recipeId) {
            this.$router.push({
                name: "recipeDetail",
                params: { recipeId: recipeId },
            });
        },
    },
};
</script>
