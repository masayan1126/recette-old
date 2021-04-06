import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import Login from "./components//auth/Login.vue";
import Register from "./components//auth/Register.vue";
import MyPage from "./components//auth/MyPage.vue";
import Top from "./components/TopPage.vue";
import RecipeDetail from "./components/recipe/RecipeDetail.vue";
import EditRecipe from "./components/recipe/EditRecipe.vue";
import RecipeList from "./components/recipe/RecipeList.vue";
import CreateRecipe from "./components/recipe/CreateRecipe.vue";
import RecipeCategoryList from "./components/recipe/RecipeCategoryList.vue";
import RecipeCategoryDetailList from "./components/recipe/RecipeCategoryDetailList.vue";
import FavoriteRecipeList from "./components/recipe/FavoriteRecipeList.vue";

const history = createWebHistory();

const router = createRouter({
    history,

    routes: [
        {
            path: "/recipes/:recipeId/edit",
            name: "editRecipe",
            component: EditRecipe,
            props: true,
        },
        {
            path: "/recipes/category/:categoryPath",
            name: "recipeCategoryDetailList",
            component: RecipeCategoryDetailList,
            props: true,
        },
        {
            path: "/recipes/:recipeId",
            name: "recipeDetail",
            component: RecipeDetail,
            props: true,
        },
        {
            path: "/recipes/list/:listType",
            name: "recipeList",
            component: RecipeList,
            props: true,
        },
        {
            path: "/recipes/create",
            name: "createRecipe",
            component: CreateRecipe,
            props: true,
        },
        {
            path: "/recipes/category",
            name: "recipeCategoryList",
            component: RecipeCategoryList,
            props: true,
        },
        {
            path: "/recipes/favorite",
            name: "favoriteRecipeList",
            component: FavoriteRecipeList,
            props: true,
        },
        {
            // routeのパス設定
            path: "/register",
            name: "register",
            component: Register,
            props: true,
        },
        {
            // routeのパス設定
            path: "/recipes",
            name: "recipes",
            component: Top,
            props: true,
        },
        {
            // routeのパス設定
            path: "/login",
            name: "login",
            component: Login,
            props: true,
        },
        {
            // routeのパス設定
            path: "/my-page",
            name: "myPage",
            component: MyPage,
            props: true,
        },
    ],
    mode: "history",
});

export default router;
