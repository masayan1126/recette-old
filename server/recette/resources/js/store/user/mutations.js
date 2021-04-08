export default {
    setUserData(state, userData) {
        state.userData.userId = userData.id;
        state.userData.userName = userData.name;
        state.userData.userEmailAdress = userData.email;
        state.userData.profileImagePath = userData.profile_photo_path;
        state.userData.loggedIn = true;
    },
    initUserData(state) {
        state.userData.userId = null;
        state.userData.userName = null;
        state.userData.userEmailAdress = null;
        state.userData.profileImagePath = null;
        state.userData.loggedIn = false;
    },
};
