export default {
    getRecipeIngredient: (state) => state.recipeIngredient,
    getRecipeIngredientList: (state) => state.recipeIngredientList,
    getIsEditingRecipeIngredient: (state) => state.isEditingRecipeIngredient,
    getEditingRecipeIngredientIndex: (state) =>
        state.editingRecipeIngredientIndex,
};
