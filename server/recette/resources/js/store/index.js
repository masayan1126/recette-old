import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

// Create a new store instance.
export const store = createStore({
    state() {
        return {
            userId: null,
        };
    },
    mutations: {
        setUserId(state, userId) {
            state.userId = userId;
        },
    },
    plugins: [createPersistedState()],
});
