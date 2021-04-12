<template>
    <button
        class="btn"
        @click.prevent="propsFunction(recipeId, isFavorite)"
        :style="buttonStyle"
    >
        {{ buttonName }}
    </button>
</template>

<script>
export default {
    name: "PrimayButton",
    props: [
        "buttonName",
        "buttonStyle",
        "isFavorite",
        "propsFunction",
        "recipeId",
    ],
};
</script>
