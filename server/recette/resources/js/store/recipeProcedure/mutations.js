export default {
    setUserId(state, userId) {
        state.userId = userId;
    },
    //
    setRecipeName(state, recipeName) {
        state.recipeName = recipeName;
    },
    initRecipeName(state) {
        state.recipeName = "";
    },
    //
    setIngredient(state, ingredient) {
        state.ingredient = ingredient;
    },
    initIngredient(state) {
        state.ingredient = null;
    },
    deleteIngredient(state, index) {
        state.ingredient = null;
        state.ingredientList.splice(index, 1);
    },
    setIngredient(state, ingredient) {
        state.ingredient = ingredient;
    },
    setIngredientList(state, { ingredient, editingIngredientIndex }) {
        // 編集
        if (state.isEditingIngredient == true) {
            state.ingredientList.splice(editingIngredientIndex, 1, ingredient);
            state.isEditingIngredient = false;
            return;
        }
        // 新規追加
        state.ingredientList.push(ingredient);
    },
    //
    initIngredientList(state) {
        state.ingredientList = [];
    },
    setIsEditingIngredient(state) {
        state.isEditingIngredient = true;
    },
    initIsEditingIngredient(state) {
        state.isEditingIngredient = false;
    },
    setEditingIngredientIndex(state, index) {
        state.editingIngredientIndex = index;
    },
    initEditingIngredientIndex(state) {
        state.editingIngredientIndex = 0;
    },
    //
    setRecipeProcedure(state, recipeProcedure) {
        state.recipeProcedure = recipeProcedure;
    },
    initRecipeProcedure(state) {
        state.recipeProcedure = "";
    },
    setRecipeProcedureList(state, recipeProcedure) {
        // 編集
        if (state.isEditingRecipeProcedure == true) {
            state.recipeProcedureList.splice(
                state.editingRecipeProcedureIndex,
                1,
                recipeProcedure
            );
            state.isEditingRecipeProcedure = false;
            return;
        }
        // 新規追加
        state.recipeProcedureList.push(recipeProcedure);
    },
    initRecipeProcedureList(state) {
        state.recipeProcedureList = [];
    },
    setIsEditingRecipeProcedure(state) {
        state.isEditingRecipeProcedure = true;
    },
    initIsEditingRecipeProcedure(state) {
        state.isEditingRecipeProcedure = false;
    },
    setEditingRecipeProcedureIndex(state, editingRecipeProcedureIndex) {
        state.editingRecipeProcedureIndex = editingRecipeProcedureIndex;
    },
    initEditingRecipeProcedureIndex(state) {
        state.editingRecipeProcedureIndex = 0;
    },
    deleteRecipeProcedure(state, index) {
        state.recipeProcedureList.splice(index, 1);
    },
    //
    goToPreviousPage(path) {
        window.location.pathname = path;
    },
};
