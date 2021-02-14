<template>
    <section class="recipe-detail-section">
        <i class="fas fa-long-arrow-alt-left fa-2x"></i>

        <div class="meal-container__recipe-deatail">
            <img
                class="meal-image__recipe-deatail"
                src="https://www.moranbong.co.jp/files/topics/3128_ext_03_0_L.jpg?v=1519087533"
                alt=""
            />
            <p class="meal-title__recipe-deatail">中華丼</p>
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
    mounted() {
        console.log("heu");
    },
    methods: {},
};
</script>
