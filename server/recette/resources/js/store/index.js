import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import getters from "./getters";
import mutations from "./mutations";
import actions from "./actions";

// Create a new store instance.
export const store = createStore({
    state() {
        return {
            userData: {
                userName: null,
                userEmailAdress: null,
                profileImagePath: null,
                loggedIn: false,
            },
            recipes: [],
            ingredients: [],
            //
            recipeName: null,
            //
            recipeIngredient: null,
            recipeIngredientList: [],
            isEditingRecipeIngredient: false,
            editingRecipeIngredientIndex: 0,
            //
            recipeProcedure: null,
            recipeProcedureList: [],
            isEditingRecipeProcedure: false,
            editingRecipeProcedureIndex: 0,
            //
            recipeCategory: null,
            recipeIngredientQuantity: null,
        };
    },
    getters: getters,
    mutations: mutations,
    actions: actions,
    plugins: [createPersistedState()],
});
