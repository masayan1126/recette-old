import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import getters from "./getters";
import mutations from "./mutations";
import actions from "./actions";

// Create a new store instance.
export const store = createStore({
    state() {
        return {
            userId: null,
            recipeName: "",
            // obj
            ingredient: null,
            ingredientList: [],
            isEditingIngredient: false,
            editingIngredientIndex: 0,
            recipeProcedure: "",
            recipeProcedureList: [],
            isEditingRecipeProcedure: false,
            editingRecipeProcedureIndex: 0,
        };
    },
    getters,
    mutations,
    actions,
    plugins: [createPersistedState()],
});
