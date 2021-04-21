export default {
    setRecipeProcedure(state, recipeProcedure) {
        state.recipeProcedure = recipeProcedure;
    },
    initRecipeProcedure(state) {
        state.recipeProcedure = null;
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
        const boolConfirmDeleteRecipeProcedure = confirm(
            "この食材を削除してよろしいですか？"
        );
        if (boolConfirmDeleteRecipeProcedure == false) {
            return;
        }
        state.recipeProcedureList.splice(index, 1);
    },
};
