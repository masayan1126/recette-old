import userMutations from "./user/mutations";
import recipeMutations from "./recipe/mutations";
import recipeIngredientMutations from "./recipeIngredient/mutations";
import recipeProcedureMutations from "./recipeProcedure/mutations";
import recipeCategoryMutations from "./recipeCategory/mutations";

export default {
    setUserId: userMutations.setUserId,
    //
    setRecipeName: recipeMutations.setRecipeName,
    initRecipeName: recipeMutations.initRecipeName,

    setRecipes: recipeMutations.setRecipes,
    initRecipes: recipeMutations.initRecipes,
    //
    setRecipeIngredient: recipeIngredientMutations.setRecipeIngredient,
    initRecipeIngredient: recipeIngredientMutations.initRecipeIngredient,
    deleteRecipeIngredient: recipeIngredientMutations.deleteRecipeIngredient,
    setRecipeIngredientList: recipeIngredientMutations.setRecipeIngredientList,
    initRecipeIngredientList:
        recipeIngredientMutations.initRecipeIngredientList,
    setIsEditingRecipeIngredient:
        recipeIngredientMutations.setIsEditingRecipeIngredient,
    initIsEditingRecipeIngredient:
        recipeIngredientMutations.initIsEditingRecipeIngredient,
    setEditingRecipeIngredientIndex:
        recipeIngredientMutations.setEditingRecipeIngredientIndex,
    initEditingRecipeIngredientIndex:
        recipeIngredientMutations.initEditingRecipeIngredientIndex,
    //
    setRecipeProcedure: recipeProcedureMutations.setRecipeProcedure,
    initRecipeProcedure: recipeProcedureMutations.initRecipeProcedure,
    setRecipeProcedureList: recipeProcedureMutations.setRecipeProcedureList,
    initRecipeProcedureList: recipeProcedureMutations.initRecipeProcedureList,
    setIsEditingRecipeProcedure:
        recipeProcedureMutations.setIsEditingRecipeProcedure,
    initIsEditingRecipeProcedure:
        recipeProcedureMutations.initIsEditingRecipeProcedure,
    setEditingRecipeProcedureIndex:
        recipeProcedureMutations.setEditingRecipeProcedureIndex,
    initEditingRecipeProcedureIndex:
        recipeProcedureMutations.initEditingRecipeProcedureIndex,
    deleteRecipeProcedure: recipeProcedureMutations.deleteRecipeProcedure,
    //
    goToPreviousPage(path) {
        window.location.pathname = path;
    },
    setRecipeCategory: recipeCategoryMutations.setRecipeCategory,
    initRecipeCategory: recipeCategoryMutations.initRecipeCategory,
};
