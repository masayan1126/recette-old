<template>
    <section class="recipe-detail-section">
        <i
            @click="returnToPreviousPage()"
            class="fas fa-long-arrow-alt-left fa-2x"
        ></i>

        <div class="meal-container__recipe-deatail">
            <div class="text-right">
                <span @click="goToRecipeEditScreen()"
                    ><i class="fas fa-pencil-alt mr-1"></i>編集</span
                >
            </div>
            <img
                class="meal-image__recipe-deatail"
                :src="targetRecipe.recipe_image_path"
                alt=""
            />
            <p class="meal-title__recipe-deatail">
                {{ targetRecipe.recipe_name }}
            </p>
            <!-- <div
                class="d-flex justify-content-between align-items-center"
            ></div> -->
        </div>
        <div class="ingredient-container__recipe-deatail">
            <p class="ingredient-title__recipe-detail">材料</p>
            <div class="ingredient-description__recipe-deatail">
                必要な材料が表示される
            </div>
        </div>
        <div class="recipe-container__recipe-deatail">
            <p class="recipe-title__recipe-detail">作り方</p>
            <div class="recipe-description__recipe-deatail">
                作り方が表示される
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "RecipeDetail",
    props: ["targetRecipe"],
    mounted() {
        console.log(this.$store.state.userId);
        console.log(this.targetRecipe);
    },
    methods: {
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            console.log(recipeId);

            location.pathname =
                "/users/" +
                this.$store.state.userId +
                "/recipes/" +
                "edit/" +
                recipeId;
        },
    },
};
</script>
