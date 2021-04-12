export default {
    data() {
        return {
            // ログイン、パスワード再設定、会員登録画面のボタンのスタイル
            authFormButtonStyle: {
                color: "#fff",
                backgroundColor: "#c4c4c4",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
        };
    },

    methods: {
        routerBack() {
            this.$router.back();
        },
        transitionToNext(pathName) {
            document
                .getElementById("navbarToggleExternalContent")
                .classList.remove("show");
            this.$router.push({ name: pathName });
        },
    },
};
