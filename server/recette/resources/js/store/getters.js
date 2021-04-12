import userGetters from "./user/getters";
import recipeGetters from "./recipe/getters";
import ingredientGetters from "./ingredient/getters";
import recipeIngredientGetters from "./recipeIngredient/getters";
import recipeProcedureGetters from "./recipeProcedure/getters";
import recipeCategoryGetters from "./recipeCategory/getters";

export default {
    // auth
    getUserData: userGetters.getUserData,
    // recipe
    getRecipeName: recipeGetters.getRecipeName,
    getRecipes: recipeGetters.getRecipes,
    getIngredients: ingredientGetters.getIngredients,
    // recipeIngredient
    getRecipeIngredient: recipeIngredientGetters.getRecipeIngredient,
    getRecipeIngredientList: recipeIngredientGetters.getRecipeIngredientList,
    getIsEditingRecipeIngredient:
        recipeIngredientGetters.getIsEditingRecipeIngredient,
    // getEditingRecipeIngredientIndex:
    //     recipeIngredientGetters.getEditingRecipeIngredientIndex,
    // recipeProcedure
    getRecipeProcedure: recipeProcedureGetters.getRecipeProcedure,
    getRecipeProcedureList: recipeProcedureGetters.getRecipeProcedureList,
    getrecipeCategory: recipeCategoryGetters.getRecipeCategory,
    getRecipeIngredientQuantity:
        recipeIngredientGetters.getRecipeIngredientQuantity,
};
