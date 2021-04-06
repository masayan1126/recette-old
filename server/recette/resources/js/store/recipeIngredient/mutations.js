export default {
    //ingredient -> recipeIngredientに書き換える
    setRecipeIngredient(state, ingredient) {
        state.recipeIngredient = ingredient;
    },
    initRecipeIngredient(state) {
        state.recipeIngredient = null;
    },
    deleteRecipeIngredient(state, index) {
        state.recipeIngredient = null;
        state.recipeIngredientList.splice(index, 1);
    },
    setRecipeIngredient(state, ingredient) {
        state.recipeIngredient = ingredient;
    },
    setRecipeIngredientList(
        state,
        { recipeIngredient, recipeIngredientQuantity }
    ) {
        recipeIngredient.recipe_ingredient_quantity = recipeIngredientQuantity;
        // 編集
        if (state.isEditingRecipeIngredient == true) {
            state.recipeIngredientList.splice(
                state.editingIngredientIndex,
                1,
                recipeIngredient
            );
            state.isEditingRecipeIngredient = false;
            return;
        }
        // 新規追加
        state.recipeIngredientList.push(recipeIngredient);
    },
    //
    initRecipeIngredientList(state) {
        state.recipeIngredientList = [];
    },
    setIsEditingRecipeIngredient(state) {
        state.isEditingRecipeIngredient = true;
    },
    initIsEditingRecipeIngredient(state) {
        state.isEditingRecipeIngredient = false;
    },
    setEditingRecipeIngredientIndex(state, index) {
        state.editingRecipeIngredientIndex = index;
    },
    initEditingRecipeIngredientIndex(state) {
        state.editingRecipeIngredientIndex = 0;
    },
    setRecipeCategory(state, recipeCategory) {
        state.recipeCategory = recipeCategory;
    },
    initRecipeCategory(state) {
        state.recipeCategory = null;
    },
    setRecipeIngredientQuantity(state, recipeIngredientQuantity) {
        state.recipeIngredientQuantity = recipeIngredientQuantity;
    },
    initRecipeIngredientQuantity(state) {
        state.recipeIngredientQuantity = null;
    },
};
