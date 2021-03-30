import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import Top from "./components/TopPage.vue";
import RecipeDetail from "./components/recipe/RecipeDetail.vue";
import RecipeList from "./components/recipe/RecipeList.vue";

const history = createWebHistory();

const router = createRouter({
    history,

    routes: [
        {
            // routeのパス設定
            path: "/",
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
            path: "/recipes/my-recipes",
            name: "myRecipes",
            component: RecipeList,
            props: true,
        },
    ],
    mode: "history",
});

export default router;
