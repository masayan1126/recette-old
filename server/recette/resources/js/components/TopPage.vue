<template>
    <div class="top-container container">
        <div class="top-container-upper d-flex mb-2">
            <!-- 検索フォーム -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Username"
                    aria-label="Username"
                    aria-describedby="basic-addon1"
                />
            </div>
            <!-- ユーザーアイコン -->
            <div>ユーザーアイコン</div>
        </div>
        <!-- マイレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-4"
        >
            <h3>マイレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div
            class="top-container-recipe-content d-flex justify-content-between"
        >
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
        </div>
        <!-- ピックアップレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-4"
        >
            <h3>ピックアップレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div
            class="top-container-recipe-content d-flex justify-content-between"
        >
            <div class="recipe" @click="showRecipeDetail()">
                <div class="recipe_image"></div>
                <span>中華丼</span>
                <form action="" method="get" name="testForm"></form>
            </div>
            <div class="recipe" @click="showRecipeDetail2((recipeId = 123))">
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
            <div class="recipe">
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
        </div>
        <!-- 旬のレシピ -->
        <div
            class="top-container-recipe-title d-flex justify-content-between mt-4"
        >
            <h3>旬のレシピ</h3>
            <p>すべて見る</p>
        </div>
        <div
            class="top-container-recipe-content d-flex justify-content-between"
        >
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
            <div>
                <div class="recipe_image"></div>
                <span>中華丼</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Top",
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        showRecipeDetail: function () {
            const recipeId = 364;
            document.testForm.action = `/users/1/recipes/${recipeId}`;
            document.testForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
        showRecipeDetail2: function (recipeId) {
            console.log(location.pathname);
            location.pathname = location.pathname + "/" + recipeId;
            // const recipeId = 364;
            // document.testForm.action = `/user/1/recipes/${recipeId}`;
            // document.testForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
    },
};
</script>
