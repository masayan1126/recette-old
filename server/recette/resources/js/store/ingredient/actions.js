export default {
    setIngredients(context, recipes) {
        context.commit("setIngredients", recipes);
    },
    initIngredients(context) {
        context.commit("initIngredients");
    },
};
