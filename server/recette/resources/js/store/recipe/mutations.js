export default {
    setRecipeName(state, recipeName) {
        state.recipeName = recipeName;
    },
    initRecipeName(state) {
        state.recipeName = null;
    },
    setRecipes(state, recipes) {
        state.recipes = recipes;
    },
    initRecipes(state) {
        state.recipes = [];
    },
};
