export default {
    //ingredient -> recipeIngredientに書き換える
    setRecipeIngredient(state, ingredient) {
        state.recipeIngredient = ingredient;
    },
    initRecipeIngredient(state) {
        state.recipeIngredient = null;
    },
    deleteRecipeIngredient(state, index) {
        const boolConfirmDeleteIngredient = confirm(
            "この食材を削除してよろしいですか？"
        );
        if (boolConfirmDeleteIngredient == false) {
            return;
        }
        state.recipeIngredient = null;
        state.recipeIngredientList.splice(index, 1);
    },
    setRecipeIngredientList(
        state,
        { recipeIngredient, recipeIngredientQuantity }
    ) {
        recipeIngredient.ingredient_quantity = recipeIngredientQuantity;

        // 食材編集の場合
        if (state.isEditingRecipeIngredient == true) {
            state.recipeIngredientList.splice(
                state.editingRecipeIngredientIndex,
                1,
                recipeIngredient
            );
            state.isEditingRecipeIngredient = false;
            return;
        }
        // 食材新規追加の場合

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
    setRecipeIngredientQuantity(state, recipeIngredientQuantity) {
        state.recipeIngredientQuantity = recipeIngredientQuantity;
    },
    initRecipeIngredientQuantity(state) {
        state.recipeIngredientQuantity = null;
    },
};
