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
                    <!-- <div
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
                    </div> -->
                </div>
                <!-- <div class="input-group">
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
                </div> -->
                <ul
                    v-for="(ingredient, index) in ingredientList"
                    :key="ingredient.id"
                >
                    <li>
                        {{ ingredient.recipe_ingredient_name
                        }}<span class=""
                            ><i
                                @click="
                                    editIngredient(
                                        index,
                                        ingredient.recipe_ingredient_name
                                    )
                                "
                                class="fas fa-pencil-alt"
                            ></i
                        ></span>
                        <span class=""
                            ><i
                                @click="deleteIngredient(index)"
                                class="fas fa-trash-alt"
                            ></i
                        ></span>
                    </li>
                </ul>
                <div class="d-flex">
                    <select
                        v-model="ingredient"
                        class="custom-select"
                        aria-label="Default select example"
                    >
                        <!-- <option selected>Open this select menu</option> -->
                        <option
                            v-for="ingredient in ingredients"
                            :value="ingredient.ingredient_name"
                            :key="ingredient.id"
                        >
                            {{ ingredient.ingredient_name }}
                        </option>
                    </select>
                    <i
                        @click="addIngredient(ingredient)"
                        class="far fa-check-circle fa-2x"
                    ></i>
                </div>
            </div>
            <div class="recipe-container__recipe-deatail">
                <p class="recipe-title__recipe-detail">作り方</p>
                <div class="recipe-description__recipe-deatail">
                    作り方が表示される
                </div>
                <PrimaryButton :propsFunc="sendEditedRecipe" />
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
    props: [
        "editingTargetRecipe",
        "editingTargetRecipeIngredients",
        "ingredients",
    ],
    data() {
        return {
            editedRecipeObj: null,
            recipeName: "",
            recipeImage: "",
            ingredient: "",
            ingredientList: [],
            index: 0,
            editing: false,
            editingIngredientIndex: 0,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {},
    mounted() {
        console.log(this.editingTargetRecipe[0].id);
        this.recipeName = this.editingTargetRecipe[0].recipe_name;
        this.ingredientList = this.editingTargetRecipeIngredients;
    },
    methods: {
        updateTargetIngredientList() {
            if (this.ingredient == "") {
                return;
            }

            this.ingredientList[
                this.index
            ].recipe_ingredient_name = this.ingredient;
            console.log(this.ingredientList[this.index].recipe_ingredient_name);
            this.ingredient = "";
        },
        createEditedRecipe: function (ingredientList) {
            console.log(this.editingTargetRecipe.id);
            const editedRecipeObj = {
                id: this.editingTargetRecipe[0].id,
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
            this.ingredient = value;
            this.index = index;
        },
        deleteIngredient: function (index) {
            this.ingredientList.splice(index, 1);
            this.ingredient = "";
        },
        returnToPreviousPage: function () {
            history.back();
        },
        editIngredient(index, recipeIngredientName) {
            this.ingredient = recipeIngredientName;
            console.log(this.ingredient);
            this.editingIngredientIndex = index;
            this.editing = true;
        },
        addIngredient(ingredient) {
            if (this.editing == true) {
                const ingredientObj = {
                    // id: index + 1,
                    recipe_ingredient_name: ingredient,
                };
                console.log(this.ingredientList[this.editingIngredientIndex]);
                this.ingredientList.splice(
                    this.editingIngredientIndex,
                    1,
                    ingredientObj
                );
                this.ingredient = "";
                this.editing = false;
                return;
            }

            this.ingredientList.push({
                // id: index + 1,
                recipe_ingredient_name: ingredient,
            });
            this.ingredient = "";
        },
    },
};
</script>
