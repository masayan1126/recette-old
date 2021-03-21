export default {
    getUserId: (state) => state.userId,
    //
    getRecipeName: (state) => state.recipeName,
    //
    getIngredient: (state) => state.ingredient,
    getIngredientList: (state) => state.ingredientList,
    getIsEditingIngredient: (state) => state.isEditingIngredient,
    getEditingIngredientIndex: (state) => state.editingIngredientIndex,
    //
    getRecipeProcedure: (state) => state.recipeProcedure,
    getRecipeProcedureList: (state) => state.recipeProcedureList,
    getIsEditingRecipeProcedure: (state) => state.isEditingRecipeProcedure,
    getEditingRecipeProcedureIndex: (state) =>
        state.editingRecipeProcedureIndex,
};
