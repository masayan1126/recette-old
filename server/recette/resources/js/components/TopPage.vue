<template>
    <section class="section-toppage">
        <div class="wrapper-toppage">
            <div class="container-header_content-toppage mb-2">
                <h4>Reccete</h4>
                <!-- ユーザーメニュー(スマートフォン) -->
                <span
                    aria-haspopup="true"
                    aria-expanded="false"
                    class="dropdown-toggle text-right"
                    data-toggle="dropdown"
                    id="dropdownMenuButton"
                    type="button"
                >
                    <img
                        alt="ユーザープロフィール画像"
                        class="w-20"
                        :src="userData.profileImagePath"
                    />
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
                    <a @click="logout" class="dropdown-item" href=""
                        >ログアウト</a
                    >
                </div>
            </div>
            <div class="container-header_content-toppage-sm">
                <!-- 検索フォーム -->
                <SearchWindow :class-name="'search-window_toppage'" />
                <div class="user_menu-sm">
                    <!-- ユーザーメニュー(タブレット以上) -->
                    <span
                        aria-haspopup="true"
                        aria-expanded="false"
                        class="dropdown-toggle"
                        data-toggle="dropdown"
                        id="dropdownMenuButton"
                        type="button"
                    >
                        <img
                            class="w-30"
                            :src="userData.profileImagePath"
                            alt="ユーザープロフィール画像"
                        />
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
                        class="w-100 element-seasonal_recipe_image-toppage"
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
                (a, b) => new Date(a.updated_at) - new Date(b.updated_at)
            );
            return newArrivalRecipes;
        },
    },
    created() {
        this.fetchAllRecipes();
        this.fetchUserIngredients();
        // apiから取得した認証情報をstoreにセット
        axios.get("api/user").then((res) => {
            this.setUserData(res.data);
        });
    },
    methods: {
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
                    console.log(this.recipes);
                })
                .catch((error) => {});
        },
        // ログインしているユーザーの食材データのみ取得
        fetchUserIngredients: async function () {
            await axios
                .get("/api/users/" + this.userData.userId + "/ingredients")
                .then((response) => {
                    this.setIngredients(response.data);
                })
                .catch((error) => {});
        },
        logout() {
            axios.post("/api/logout").then((res) => {
                this.initUserData();
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
