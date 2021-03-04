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
                :src="targetRecipe[0].recipe_image_path"
                alt=""
            />
            <p class="meal-title__recipe-deatail">
                {{ targetRecipe[0].recipe_name }}
            </p>
        </div>
        <div class="ingredient-container__recipe-deatail">
            <p class="ingredient-title__recipe-detail">材料</p>
            <div class="ingredient-description__recipe-deatail">
                <ul
                    v-for="targetRecipeIngredient in targetRecipeIngredients"
                    :key="targetRecipeIngredient.id"
                >
                    <li>{{ targetRecipeIngredient.recipe_ingredient_name }}</li>
                </ul>
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
    props: ["targetRecipe", "targetRecipeIngredients"],
    data() {
        return {
            targetIngredientList: [],
        };
    },
    mounted() {},
    methods: {
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];

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
