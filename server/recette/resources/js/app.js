/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import { createApp } from "vue";
import { store } from "./store";
import TopPage from "./components/TopPage.vue";
import RecipeList from "./components/recipe/RecipeList";
import RecipeDetail from "./components/recipe/RecipeDetail.vue";
import EditRecipe from "./components/recipe/EditRecipe.vue";
import CreateRecipe from "./components/recipe/CreateRecipe.vue";
import StoreRecipe from "./components/recipe/StoreRecipe.vue";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// window.HelloComponent = require("./components/Hello.vue").default;

createApp({
    components: {
        TopPage,
        RecipeDetail,
        EditRecipe,
        CreateRecipe,
        StoreRecipe,
        RecipeList,
    },
})
    .use(store)
    .mount("#app");
