export default {
    setRecipeName(state, recipeName) {
        state.recipeName = recipeName;
    },
    initRecipeName(state) {
        state.recipeName = "";
    },
    setRecipes(state, recipes) {
        state.recipes = recipes;
    },
    initRecipes(state) {
        state.recipes = [];
    },
};
