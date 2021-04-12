export default {
    setRecipes(context, recipes) {
        context.commit("setRecipes", recipes);
    },
    initRecipes(context) {
        context.commit("initRecipes");
    },
};
