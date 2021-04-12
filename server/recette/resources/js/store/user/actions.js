export default {
    setUserData(context, recipes) {
        context.commit("setUserData", recipes);
    },
    initUserData(context) {
        context.commit("initUserData");
    },
};
