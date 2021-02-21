<template>
    <div class="top-container container">
        <div class="top-container-upper d-flex mb-5">
            <!-- 検索フォーム -->
            <div style="width: 80%">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"
                            >@</span
                        >
                    </div>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Username"
                        aria-label="Username"
                        aria-describedby="basic-addon1"
                    />
                </div>
            </div>
            <!-- ユーザーアイコン -->
            <i class="far fa-user-circle fa-2x"></i>
        </div>
        <!-- マイレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h3>マイレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div class="top-container-recipe-content">
            <div
                class="recipe"
                @click="showRecipeDetail(recipe.id)"
                v-for="recipe in recipes"
                :key="recipe.id"
            >
                <img
                    class="recipe_image"
                    :src="recipe.recipe_image_path"
                    alt=""
                />

                <p>{{ recipe.recipe_name }}</p>
                <!-- <form action="" method="get" name="testForm"></form> -->
            </div>
        </div>
        <!-- ピックアップレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h3>おすすめレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div class="top-container-recipe-content">
            <div
                class="recipe"
                @click="showRecipeDetail(recipe.id)"
                v-for="recipe in recipes"
                :key="recipe.id"
            >
                <img
                    class="recipe_image"
                    :src="recipe.recipe_image_path"
                    alt=""
                />

                <p>{{ recipe.recipe_name }}</p>
                <!-- <form action="" method="get" name="testForm"></form> -->
            </div>
        </div>
        <!-- 旬のレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h3>旬のレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div class="top-container-recipe-content">
            <div
                class="recipe"
                @click="showRecipeDetail(recipe.id)"
                v-for="recipe in recipes"
                :key="recipe.id"
            >
                <img
                    class="recipe_image"
                    :src="recipe.recipe_image_path"
                    alt=""
                />

                <p>{{ recipe.recipe_name }}</p>
                <!-- <form action="" method="get" name="testForm"></form> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Top",
    props: ["userId", "recipes"],
    data() {
        return {
            recipeName: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {
        console.log(location.pathname.split("/users/")[1]);
        this.$store.commit("setUserId", this.userId);
    },
    mounted() {},
    methods: {
        showRecipeDetail: function (recipeId) {
            location.pathname = location.pathname + "/" + recipeId;
        },
    },
};
</script>
