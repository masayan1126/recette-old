<template>
    <button
        class="btn"
        @click.prevent="propsFunction(recipeId, isFavorite)"
        :style="buttonStyle"
    >
        <i :class="icon"></i>
        {{ buttonName }}
    </button>
</template>

<script>
import Button from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button.vue";
export default {
    components: { Button },
    name: "EditRecipe",
    props: [
        "buttonName",
        "propsFunction",
        "recipeId",
        "isFavorite",
        "buttonStyle",
        "icon",
    ],
    data() {
        return {
            revisedRecipeObj: null,
            revisedRecipeName: "",
            revisedRecipeImage: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {
        // this.revisedRecipeName = this.editTargetRecipe.recipe_name;
    },
    mounted() {
        // console.log(this.editTargetRecipe);
    },
    methods: {
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            console.log(recipeId);

            location.pathname =
                "/users/" +
                this.$store.state.userId +
                "/recipes/" +
                "edit/" +
                recipeId;

            // location.pathname = `/users/${this.$store.state.userId} + "/" + recipeId`;
            // const recipeId = 364;
            // document.testForm.action = `/user/1/recipes/${recipeId}`;
            // document.testForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
    },
};
</script>
