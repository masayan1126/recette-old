<template>
    <nav class="nav-fix-bottom navbar shadow-sm w-100">
        <div class="nav-fix-bottom-container">
            <div
                @click="transitionToNext('createRecipe')"
                class="d-flex flex-column text-center"
            >
                <i class="fas fa-folder-plus"></i>
                <span>レシピ追加 </span>
            </div>
            <!--  -->
            <div
                @click="transitionToNext('favoriteRecipeList')"
                class="d-flex flex-column text-center"
            >
                <i class="fas fa-clipboard-list fa-2x"></i>
                <span> お気に入り </span>
            </div>
            <!--  -->

            <div
                @click="transitionToNext('recipeCategoryList')"
                class="d-flex flex-column text-center"
            >
                <i class="fas fa-search fa-2x"></i>
                <span> レシピを探す </span>
            </div>
            <!--  -->
            <div
                @click="transitionToNext('recipeCategoryList')"
                class="d-flex flex-column text-center"
            >
                <i class="fas fa-calendar-alt fa-2x"></i>
                <span> カレンダー </span>
            </div>
        </div>
    </nav>
</template>

<script>
import utilsMixin from "../../mixin/utility";
export default {
    mixins: [utilsMixin],
    name: "Navbar",
};
</script>
