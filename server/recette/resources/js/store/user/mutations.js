export default {
    setUserId(state, userId) {
        state.userId = userId;
    },
    setUserData(state, userData) {
        state.userData.userId = userData.id;
        state.userData.userName = userData.name;
        state.userData.userEmailAdress = userData.email;
        state.userData.profileImagePath = userData.profile_photo_path;
    },
};
