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
    //
    setRecipeGenre(state, recipeGenre) {
        state.recipeGenre = recipeGenre;
    },
    initRecipeGenre(state) {
        state.recipeGenre = null;
    },
    setCookingTime(state, cookingTime) {
        state.cookingTime = cookingTime;
    },
    initCookingTime(state) {
        state.cookingTime = null;
    },
    setBotReccomendedRecipes(state, botReccomendedRecipes) {
        state.botReccomendedRecipes = botReccomendedRecipes;
    },
    initBotReccomendedRecipes(state) {
        state.botReccomendedRecipes = [];
    },
};
