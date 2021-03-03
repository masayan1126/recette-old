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
            id="edit-recipe-form"
            name="editRecipeForm"
        >
            <input type="hidden" name="_token" :value="csrf" />
            <input
                type="hidden"
                name="editedRecipe"
                :value="JSON.stringify(editedRecipeObj)"
            />
            <div class="meal-container__recipe-deatail">
                <div class="meal-image__recipe-deatail">
                    <!-- <label for="">
                        <input type="file" class="d-none" />
                        <img class="w-75 h-75" :src="recipeImage" alt="" />
                    </label> -->
                    <ImagePreview
                        :recipeImage="editingTargetRecipe.recipe_image_path"
                    />
                    <!-- <p class="text-right">
                        <i class="fas fa-upload"></i>画像をUL
                    </p> -->
                </div>

                <div class="input-group">
                    <input
                        class="form-control meal-title__recipe-deatail"
                        type="text"
                        v-model="recipeName"
                    />
                </div>
            </div>
            <div class="ingredient-container__recipe-deatail">
                <p class="ingredient-title__recipe-detail">材料</p>
                <div class="ingredient-description__recipe-deatail">
                    <div
                        v-for="ingredient in ingredientList"
                        :key="ingredient.id"
                    >
                        <TextInput
                            :index="index"
                            :deleteIngredient="deleteIngredient"
                            @setEditingTargetIngredientName="set"
                            :value="ingredient.recipe_ingredient_name"
                            @inputFormContent="ingredientName = $event"
                        />
                    </div>
                </div>
                <div class="input-group">
                    <textarea
                        class="form-control"
                        v-model="ingredientName"
                        name=""
                        id=""
                    ></textarea>
                    <div class="input-group-append">
                        <span
                            @click="updateTargetIngredientList()"
                            class="input-group-text"
                            >確定</span
                        >
                    </div>
                </div>
            </div>
            <div class="recipe-container__recipe-deatail">
                <p class="recipe-title__recipe-detail">作り方</p>
                <div class="recipe-description__recipe-deatail">
                    作り方が表示される
                </div>
                <PrimaryButton :sendEditedRecipe="sendEditedRecipe" />
            </div>
        </form>
    </section>
</template>

<script>
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import ImagePreview from "../parts/ImagePreview";
export default {
    components: { PrimaryButton, TextInput, ImagePreview },
    name: "EditRecipe",
    props: ["editingTargetRecipe", "editingTargetRecipeIngredients"],
    data() {
        return {
            editedRecipeObj: null,
            recipeName: "",
            recipeImage: "",
            ingredientName: "",
            ingredientList: [],
            index: 0,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {},
    mounted() {
        this.recipeName = this.editingTargetRecipe.recipe_name;
        this.ingredientList = this.editingTargetRecipeIngredients;
        console.log(this.ingredientList);
    },
    methods: {
        updateTargetIngredientList() {
            if (this.ingredientName == "") {
                return;
            }

            this.ingredientList[
                this.index
            ].recipe_ingredient_name = this.ingredientName;
            console.log(this.ingredientList[this.index].recipe_ingredient_name);
            this.ingredientName = "";
        },
        createEditedRecipe: function (ingredientList) {
            const editedRecipeObj = {
                id: this.editingTargetRecipe.id,
                editedRecipeName: this.recipeName,
                editedRecipeImage: this.recipeImage,
                editedIngredients: this.ingredientList,
            };
            this.editedRecipeObj = editedRecipeObj;
        },
        sendEditedRecipe: function () {
            this.createEditedRecipe();
            const userId = this.$store.state.userId;
            document.editRecipeForm.action = `/users/${userId}/recipes/update`;
            document.editRecipeForm.submit();
        },
        set(value, index) {
            this.ingredientName = value;
            this.index = index;
        },
        deleteIngredient: function (index) {
            this.ingredientList.splice(index, 1);
            this.ingredientName = "";
        },
        returnToPreviousPage: function () {
            history.back();
        },
    },
};
</script>
