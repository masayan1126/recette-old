// export default {
//     setIngredient(state, ingredient) {
//         state.ingredient = ingredient;
//     },
//     initIngredient(state) {
//         state.ingredient = null;
//     },
//     deleteIngredient(state, index) {
//         state.ingredient = null;
//         state.ingredientList.splice(index, 1);
//     },
//     setIngredient(state, ingredient) {
//         state.ingredient = ingredient;
//     },
//     setIngredientList(state, { ingredient, editingIngredientIndex }) {
//         // 編集
//         if (state.isEditingIngredient == true) {
//             state.ingredientList.splice(editingIngredientIndex, 1, ingredient);
//             state.isEditingIngredient = false;
//             return;
//         }
//         // 新規追加
//         state.ingredientList.push(ingredient);
//     },
//     //
//     initIngredientList(state) {
//         state.ingredientList = [];
//     },
//     setIsEditingIngredient(state) {
//         state.isEditingIngredient = true;
//     },
//     initIsEditingIngredient(state) {
//         state.isEditingIngredient = false;
//     },
//     setEditingIngredientIndex(state, index) {
//         state.editingIngredientIndex = index;
//     },
//     initEditingIngredientIndex(state) {
//         state.editingIngredientIndex = 0;
//     },
// };
