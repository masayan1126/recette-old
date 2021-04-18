import { createRouter, createWebHistory } from "vue-router";
import Login from "./components//auth/Login.vue";
import Register from "./components//auth/Register.vue";
import Forgot from "./components//auth/Forgot.vue";
import Reset from "./components//auth/Reset.vue";
import MyPage from "./components//auth/MyPage.vue";
import NotFound from "./components//common/NotFound.vue";
import Top from "./components/TopPage.vue";
import RecipeDetail from "./components/recipe/RecipeDetail.vue";
import IngredientList from "./components/ingredient/IngredientList.vue";
import RecipeBot from "./components/recipe/bot/RecipeBot";
import EditRecipe from "./components/recipe/EditRecipe.vue";
import RecipeList from "./components/recipe/RecipeList.vue";
import CreateRecipe from "./components/recipe/CreateRecipe.vue";
import RecipeCategoryList from "./components/recipe/RecipeCategoryList.vue";
import RecipeCategoryDetailList from "./components/recipe/RecipeCategoryDetailList.vue";
import FavoriteRecipeList from "./components/recipe/FavoriteRecipeList.vue";

const history = createWebHistory();
const router = createRouter({
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top

        return {
            el: "#app",
            top: 0,
        };
    },
    history,
    routes: [
        {
            path: "/bot",
            name: "recipeBot",
            component: RecipeBot,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/:recipeId/edit",
            name: "editRecipe",
            component: EditRecipe,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then((res) => {
                        axios
                            .post("/api/check/routing", {
                                id: to.params.recipeId,
                            })
                            .then((res) => {
                                console.log(res);
                                if (res.data.length == 0) {
                                    next({ path: "/404" });
                                } else {
                                    next();
                                }
                            })
                            .catch(() => {
                                next({ path: "/404" });
                            });
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/category/:categoryPath",
            name: "recipeCategoryDetailList",
            component: RecipeCategoryDetailList,
            props: true,
            beforeEnter: (to, form, next) => {
                console.log(to.params.categoryPath);
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        if (
                            to.params.categoryPath != "meat" &&
                            to.params.categoryPath != "fish" &&
                            to.params.categoryPath != "veg" &&
                            to.params.categoryPath != "noodle" &&
                            to.params.categoryPath != "rice" &&
                            to.params.categoryPath != "soup" &&
                            to.params.categoryPath != "bread" &&
                            to.params.categoryPath != "sweets" &&
                            to.params.categoryPath != "other"
                        ) {
                            next({ path: "/404" });
                            return;
                        }
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/:recipeId",
            name: "recipeDetail",
            component: RecipeDetail,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        axios
                            .post("/api/check/routing", {
                                id: to.params.recipeId,
                            })
                            .then((res) => {
                                console.log(res);
                                if (res.data.length == 0) {
                                    next({ path: "/404" });
                                } else {
                                    next();
                                }
                            })
                            .catch(() => {
                                next({ path: "/404" });
                            });
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/list/:listType",
            name: "recipeList",
            component: RecipeList,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        if (
                            to.params.listType != "my-recipes" &&
                            to.params.listType != "new-arrival-recipes" &&
                            to.params.listType != "search-result-recipe" &&
                            to.params.listType != "bot-recommend-recipes"
                        ) {
                            next({ path: "/404" });
                            return;
                        }
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/create",
            name: "createRecipe",
            component: CreateRecipe,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/category",
            name: "recipeCategoryList",
            component: RecipeCategoryList,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/recipes/favorite",
            name: "favoriteRecipeList",
            component: FavoriteRecipeList,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/register",
            name: "register",
            component: Register,
            props: true,
        },
        {
            path: "/forgot",
            name: "forgot",
            component: Forgot,
            props: true,
        },
        {
            path: "/reset",
            name: "reset",
            component: Reset,
            props: true,
        },
        {
            path: "/recipes",
            name: "recipes",
            component: Top,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/user")
                    .then(() => {
                        next();
                    })
                    .catch((error) => {
                        console.log(error);
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/ingredients",
            name: "ingredientList",
            component: IngredientList,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/user")
                    .then(() => {
                        next();
                    })
                    .catch((error) => {
                        console.log(error);
                        return next({ name: "login" });
                    });
            },
        },
        {
            // routeのパス設定
            path: "/",
            name: "/",
            component: Top,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        return next({ name: "recipes" });
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            props: true,
        },
        {
            path: "/mypage",
            name: "myPage",
            component: MyPage,
            props: true,
            beforeEnter: (to, form, next) => {
                axios
                    .get("/api/athenticated")
                    .then(() => {
                        next();
                    })
                    .catch(() => {
                        return next({ name: "login" });
                    });
            },
        },
        {
            path: "/:pathMatch(.*)*",
            name: "notFound",
            component: NotFound,
        },
    ],
    mode: "history",
});

export default router;
