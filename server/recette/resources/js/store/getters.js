import userGetters from "./user/getters";
import recipeGetters from "./recipe/getters";
import recipeIngredientGetters from "./recipeIngredient/getters";
import recipeProcedureGetters from "./recipeProcedure/getters";
import recipeCategoryGetters from "./recipeCategory/getters";

export default {
    // auth
    getUserId: userGetters.getUserId,
    // recipe
    getRecipeName: recipeGetters.getRecipeName,
    getRecipes: recipeGetters.getRecipes,
    // recipeIngredient
    getRecipeIngredient: recipeIngredientGetters.getRecipeIngredient,
    getRecipeIngredientList: recipeIngredientGetters.getRecipeIngredientList,
    getIsEditingRecipeIngredient:
        recipeIngredientGetters.getIsEditingRecipeIngredient,
    getEditingRecipeIngredientIndex:
        recipeIngredientGetters.getEditingRecipeIngredientIndex,
    // recipeProcedure
    getRecipeProcedure: recipeProcedureGetters.getRecipeProcedure,
    getRecipeProcedureList: recipeProcedureGetters.getRecipeProcedureList,
    getIsEditingRecipeProcedure:
        recipeProcedureGetters.getIsEditingRecipeProcedure,
    getEditingRecipeProcedureIndex:
        recipeProcedureGetters.getEditingRecipeProcedureIndex,
    getrecipeCategory: recipeCategoryGetters.getRecipeCategory,
};
