<template>
    <section class="section-toppage">
        <div class="wrapper-toppage">
            <div class="container-header_content-toppage mb-2">
                <h4>Reccete</h4>
                <!-- ユーザーメニュー -->
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
                    <a @click="logout" class="dropdown-item" href="#"
                        >ログアウト</a
                    >
                </div>
            </div>
            <div class="container-header_content-toppage-sm">
                <!-- 検索フォーム -->
                <SearchWindow :className="'search-window_toppage'" />
                <div class="user_menu-sm">
                    <!-- ユーザーメニュー -->
                    <span
                        class="dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fas fa-user-circle fa-3x"></i>
                    </span>

                    <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <router-link
                            :to="{
                                name: 'myPage',
                            }"
                            class="dropdown-item"
                        >
                            マイページ
                        </router-link>
                        <a @click="logout" class="dropdown-item" href="#"
                            >ログアウト</a
                        >
                    </div>
                </div>
            </div>
            <!-- <VueSimpleSuggest
                v-model="chosen"
                :list="simpleSuggestionList"
                :filter-by-query="true"
            /> -->

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
            <div class="container-myrecipe-toppage" v-if="myRecipes.length > 0">
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
            <div class="container-new_arrival_recipe-toppage">
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
            <div class="container-seasonal_recipe-toppage d-flex w-100">
                <div
                    class="w-100 cursor-pointer"
                    @click="showRecipeDetail(recipe.id)"
                    v-for="recipe in newArrivalRecipes"
                    :key="recipe.id"
                >
                    <img
                        style="
                            box-shadow: 0px 2px 2px rgb(0 0 0 / 25%);
                            border-radius: 5px;
                        "
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
import { mapGetters, mapMutations } from "vuex";
import SearchWindow from "./parts/SearchWindow";
// import VueSimpleSuggest from "vue-simple-suggest";
// import "vue-simple-suggest/dist/styles.css"; // Optional CSS
export default {
    name: "TopPage",
    components: {
        SearchWindow,
        // VueSimpleSuggest,
    },
    data() {
        return {
            // chosen: "",
            // csrf: document
            //     .querySelector('meta[name="csrf-token"]')
            //     .getAttribute("content"),
        };
    },
    created() {
        this.fetchAllRecipes();
        this.fetchUserIngredients();
        // spiから取得した認証情報をstoreにセット
        axios.get("api/user").then((res) => {
            this.setUserData(res.data);
        });
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
            ingredients: "getIngredients",
        }),
        myRecipes() {
            // 非破壊コピーして日付の昇順にソート
            return this.recipes.filter(
                (recipe) => recipe.user_id == this.userData.userId
            );
        },
        newArrivalRecipes() {
            // 非破壊コピーして日付の昇順にソート
            const newArrivalRecipes = this.recipes.slice();
            newArrivalRecipes.sort(
                (a, b) => new Date(a.updated_at) - new Date(b.updated_at)
            );
            return newArrivalRecipes;
        },
    },
    methods: {
        ...mapMutations([
            "setRecipes",
            "initRecipes",
            "setUserData",
            "initUserData",
            "setIngredients",
            "initIngredients",
        ]),
        // simpleSuggestionList() {
        //     [
        //         { id: 1, firstName: "タロウ", lastName: "サトウ" },
        //         { id: 2, firstName: "ジロウ", lastName: "イノウエ" },
        //         { id: 3, firstName: "サブロウ", lastName: "タナカ" },
        //     ];
        // },
        // ログインしているユーザーにかかわらず、全てのレシピを取得
        fetchAllRecipes: async function () {
            await axios
                .get("/api/recipes")
                .then((response) => {
                    this.setRecipes(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        // ログインしているユーザーの食材データのみ取得
        fetchUserIngredients: async function () {
            await axios
                .get("/api/users/" + this.userData.userId + "/ingredients")
                .then((response) => {
                    this.setIngredients(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        logout() {
            axios.post("/api/logout").then((res) => {
                this.initUserData();
                console.log(this.userData);
                this.$router.push("/login");
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
