export default {
    data() {
        return {
            // ログイン、パスワード再設定、会員登録画面のボタンのスタイル
            authFormButtonStyle: {
                color: "#fff",
                backgroundColor: "#c4c4c4",
                width: "100%",
            },
        };
    },

    computed: {
        // レシピ新規作成、編集コンポーネントで使用
        cookingTime: {
            get() {
                return this.$store.getters.getCookingTime;
            },
            set(val) {
                this.setCookingTime(val);
            },
        },
        recipeName: {
            get() {
                return this.$store.getters.getRecipeName;
            },
            set(val) {
                this.setRecipeName(val);
            },
        },
        recipeIngredient: {
            get() {
                return this.$store.getters.getRecipeIngredient;
            },
            set(val) {
                this.setRecipeIngredient(val);
            },
        },
        recipeIngredientQuantity: {
            get() {
                return this.$store.getters.getRecipeIngredientQuantity;
            },
            set(val) {
                this.setRecipeIngredientQuantity(val);
            },
        },
        recipeCategory: {
            get() {
                return this.$store.getters.getrecipeCategory;
            },
            set(val) {
                this.setRecipeCategory(val);
            },
        },
        recipeGenre: {
            get() {
                return this.$store.getters.getRecipeGenre;
            },
            set(val) {
                this.setRecipeGenre(val);
            },
        },
        recipeProcedure: {
            get() {
                return this.$store.getters.getRecipeProcedure;
            },
            set(val) {
                this.setRecipeProcedure(val);
            },
        },
    },

    methods: {
        // 戻るボタンが必要な画面すべてで使用
        routerBack() {
            this.$router.back();
        },
        // ナビメニューで使用
        transitionToNext(pathName) {
            document
                .getElementById("navbarToggleExternalContent")
                .classList.remove("show");
            this.$router.push({ name: pathName });
        },
    },
};
