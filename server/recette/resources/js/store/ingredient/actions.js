export default {
    setIngredients(context, ingredients) {
        context.commit("setIngredients", ingredients);
    },
    initIngredients(context) {
        context.commit("initIngredients");
    },
};
