<template>
    <section class="recipe-detail-section">
        <h3>レシピ編集</h3>
        <i
            @click="returnToPreviousPage()"
            class="fas fa-long-arrow-alt-left fa-2x"
        ></i>

        <form
            action=""
            method="POST"
            enctype="multipart/form-data"
            id="create-recipe-form"
            name="createRecipeForm"
        >
            <input type="hidden" name="_token" :value="csrf" />
            <input
                type="hidden"
                name="revised_recipe"
                :value="JSON.stringify(revisedRecipeObj)"
            />
            <div class="meal-container__recipe-deatail">
                <div class="text-right"></div>
                <img
                    class="meal-image__recipe-deatail"
                    :src="editingTargetRecipe.recipe_image_path"
                    alt=""
                />
                <input
                    v-model="revisedRecipeName"
                    class="meal-title__recipe-deatail"
                />
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
                <PrimaryButton :showRecipeDetail="showRecipeDetail" />
            </div>
        </form>
    </section>
</template>

<script>
import PrimaryButton from "../parts/PrimaryButton";
export default {
    components: { PrimaryButton },
    name: "EditRecipe",
    props: ["editingTargetRecipe"],
    data() {
        return {
            revisedRecipeObj: null,
            revisedRecipeName: "",
            revisedRecipeImage: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {},
    mounted() {
        console.log(this.editingTargetRecipe);
        this.revisedRecipeName = this.editingTargetRecipe.recipe_name;
    },
    methods: {
        showRecipeDetail: function () {
            const userId = this.$store.state.userId;
            // axios
            //     .post("users/" + userId + "/recipes/update", "axiosテスト", {
            //         headers: { "content-type": "multipart/form-data" },
            //     })
            //     .then((res) => {
            //         // location.pathname = "/users/" + userId + "/recipes";
            //     })
            //     .catch((error) => {
            //         new Error(error);
            //     });

            const revisedRecipeObj = {
                id: this.editingTargetRecipe.id,
                revisedRecipeName: this.revisedRecipeName,
                revisedRecipeImage: this.revisedRecipeImage,
            };
            this.revisedRecipeObj = revisedRecipeObj;

            document.createRecipeForm.action = `/users/${userId}/recipes/update`;
            document.createRecipeForm.submit();
        },
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

            // location.pathname = `/users/${this.$store.state.userId} + "/" + recipeId`;
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
