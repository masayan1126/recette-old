<template>
    <div class="w-100 shadow">
        <nav class="navbar navbar-top-hamburger">
            <div
                class="navbar-dark d-flex justify-content-between align-items-center"
            >
                <h4
                    @click="transitionToNext('recipes')"
                    class="mb-0 cursor-pointer"
                >
                    Recette
                </h4>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarToggleExternalContent"
                    aria-controls="navbarToggleExternalContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse" id="navbarToggleExternalContent">
                <ul>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('createRecipe')"
                    >
                        <i class="mr-1 fas fa-folder-plus"></i>レシピ追加
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('favoriteRecipeList')"
                    >
                        <i class="mr-1 fas fa-clipboard-list"></i>お気に入り
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('recipeCategoryList')"
                    >
                        <i class="mr-1 fas fa-folder-plus"></i>レシピを探す
                    </li>
                    <li
                        class="cursor-pointer"
                        @click="transitionToNext('recipeBot')"
                    >
                        <i class="fas fa-robot fa-2x"></i>献立くん
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import utilsMixin from "../../mixin/utility";
export default {
    mixins: [utilsMixin],
    name: "NavbarTopHumburger",
};
</script>
