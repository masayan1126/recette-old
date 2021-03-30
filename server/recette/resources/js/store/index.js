import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import getters from "./getters";
import mutations from "./mutations";

// Create a new store instance.
export const store = createStore({
    state() {
        return {
            userId: null,
            recipeName: "",
            recipes: [],
            // obj
            recipeIngredient: null,
            recipeIngredientList: [],
            isEditingRecipeIngredient: false,
            editingRecipeIngredientIndex: 0,
            recipeProcedure: "",
            recipeProcedureList: [],
            isEditingRecipeProcedure: false,
            editingRecipeProcedureIndex: 0,
            recipeCategory: "",
        };
    },
    getters: getters,
    mutations: mutations,
    plugins: [createPersistedState()],
});
