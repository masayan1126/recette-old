<template>
    <button
        class="btn font_size-resize"
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
