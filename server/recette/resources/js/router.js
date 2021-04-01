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

const history = createWebHistory();

const router = createRouter({
    history,

    routes: [
        {
            // routeのパス設定
            path: "/register",
            component: Register,
            props: true,
        },
        {
            // routeのパス設定
            path: "/login",
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
        {
            // routeのパス設定
            path: "/recipes",
            name: "recipes",
            component: Top,
            props: true,
        },
        {
            path: "/recipes/:recipeId",
            name: "recipeDetail",
            component: RecipeDetail,
            props: true,
        },
        {
            path: "/recipes/:recipeId/edit",
            name: "editRecipe",
            component: EditRecipe,
            props: true,
        },
        {
            path: "/recipes/my-recipes",
            name: "myRecipes",
            component: RecipeList,
            props: true,
        },
        {
            path: "/recipes/create",
            name: "createRecipe",
            component: CreateRecipe,
            props: true,
        },
    ],
    mode: "history",
});

export default router;
