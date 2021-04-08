<template>
    <button
        class="btn"
        @click.prevent="propsFunction(recipeId, isFavorite)"
        :style="buttonStyle"
    >
        <i :class="icon" style="color: red"></i>
        {{ buttonName }}
    </button>
</template>

<script>
export default {
    name: "PrimayButton",
    props: [
        "buttonName",
        "propsFunction",
        "recipeId",
        "buttonStyle",
        "icon",
        "isFavorite",
    ],
    data() {
        return {
            revisedRecipeObj: null,
            revisedRecipeName: "",
            revisedRecipeImage: "",
        };
    },
};
</script>
