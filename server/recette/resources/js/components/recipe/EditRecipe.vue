<template>
    <section class="section-recipe_edit">
        <div class="wrapper-recipe_edit">
            <!-- <ReturnButton :path-name="'recipeDetail'" :recipe-id="recipeId" /> -->
            <router-link
                :to="{
                    name: 'recipeDetail',
                    params: { recipeId: recipeId },
                }"
            >
                <i class="fas fa-angle-left fa-2x"></i>
            </router-link>

            <ImagePreview :title="'レシピ画像UL'" />

            <img
                class="w-100"
                :src="selectedRecipe[0].recipe_image_path"
                alt=""
            />

            <div class="container-recipe mb-4 d-flex">
                <label>レシピ名：</label>
                <input
                    class="text-input"
                    type="text"
                    id="recipe-name"
                    v-model="recipeName"
                />
            </div>

            <div class="container-recipe_ingredient mb-4">
                <p class="mb-0">材料</p>
                <div class="area-ingredient">
                    <ul
                        class="pl-1"
                        v-for="(ingredient, index) in ingredientList"
                        :key="ingredient.id"
                    >
                        <li>
                            {{ ingredient.recipe_ingredient_name }}
                            <span
                                ><i
                                    @click="editIngredient(ingredient, index)"
                                    class="ml-2 fas fa-pencil-alt"
                                ></i
                            ></span>
                            <span
                                ><i
                                    @click="deleteIngredient(index)"
                                    class="ml-2 fas fa-trash-alt"
                                ></i
                            ></span>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <select v-model="ingredient" class="custom-select mr-1">
                            <option
                                v-for="ingredient in ingredients"
                                :value="ingredient"
                                :key="ingredient.id"
                            >
                                {{ ingredient.ingredient_name }}
                            </option>
                        </select>
                        <i
                            @click.prevent="addIngredient"
                            class="far fa-check-circle fa-2x"
                        ></i>
                    </div>
                </div>
            </div>

            <div class="container-recipe_procedure mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>
                    <span>
                        <i class="mr-1 fas fa-book-open"></i>レシピURL
                    </span>
                </div>
                <div class="area-recipe_procedure p-2">
                    <ul
                        class="pl-1"
                        v-for="(recipeProcedure, index) in selectedRecipe[0]
                            .recipeProcedureList"
                        :key="recipeProcedure.toString(index)"
                    >
                        <li>
                            {{ index + 1 }}.{{ recipeProcedure
                            }}<i
                                @click="
                                    editRecipeProcedure(recipeProcedure, index)
                                "
                                class="ml-2 fas fa-pencil-alt"
                            ></i>
                            <i
                                @click="deleteRecipeProcedure(index)"
                                class="ml-2 fas fa-trash-alt"
                            ></i>
                        </li>
                    </ul>
                    <div class="form-group">
                        <textarea
                            v-model="recipeProcedureInputField"
                            class="form-control"
                            id="recipe-procedure-input-field"
                            rows="2"
                        ></textarea>
                    </div>

                    <div @click="addRecipeProcedure" class="text-right">
                        <i class="mr-1 fas fa-plus"></i>追加
                    </div>
                </div>
            </div>

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
                <PrimaryButton
                    :buttonName="'登録する'"
                    :propsFunc="sendEditedRecipe"
                    :buttonStyle="addRecipeButtonStyle"
                />
            </form>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import ReturnButton from "../parts/ReturnButton";
import TextInput from "../parts/TextInput";
import ImagePreview from "../parts/ImagePreview";

export default {
    components: { PrimaryButton, TextInput, ImagePreview, ReturnButton },
    name: "EditRecipe",
    props: ["recipeId"],
    data() {
        return {
            editedRecipeObj: null,
            addRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "10px",
                height: "35px",
                width: "100%",
            },
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
            recipes: "getRecipes",
            ingredients: "getIngredients",
            recipeIngredientList: "getRecipeIngredientList",
            isEditingIngredient: "getIsEditingRecipeIngredient",
            editingIngredientIndex: "getEditingRecipeIngredientIndex",
            recipeProcedureList: "getRecipeProcedureList",
            isEditingRecipeProcedure: "getIsEditingRecipeProcedure",
            editingRecipeProcedureIndex: "getEditingRecipeProcedureIndex",
        }),
        selectedRecipe() {
            return this.recipes.filter((recipe) => recipe.id == this.recipeId);
        },

        recipeName: {
            get() {
                return this.$store.getters.getRecipeName;
            },
            set(val) {
                this.setRecipeName(val);
            },
        },
        ingredient: {
            get() {
                return this.$store.getters.getIngredient;
            },
            set(val) {
                this.setIngredient(val);
            },
        },
    },
    created() {},
    mounted() {
        console.log(this.selectedRecipe, this.recipeId);
        this.recipeName = this.selectedRecipe[0].recipe_name;
        this.ingredientList = this.ingredients;
    },

    methods: {
        ...mapMutations([
            "setRecipeName",
            "initRecipeName",
            "setRecipeIngredient",
            "initRecipeIngredient",
            "deleteRecipeIngredient",
            "setRecipeIngredientList",
            "initRecipeIngredientList",
            "setIsEditingRecipeIngredient",
            "initIsEditingRecipeIngredient",
            "setEditingRecipeIngredientIndex",
            "initEditingRecipeIngredientIndex",
            "setRecipeProcedure",
            "initRecipeProcedure",
            "setRecipeProcedureList",
            "initRecipeProcedureList",
            "setIsEditingRecipeProcedure",
            "initIsEditingRecipeProcedure",
            "setEditingRecipeProcedureIndex",
            "initEditingRecipeProcedureIndex",
            "deleteRecipeProcedure",
            "setRecipeCategory",
            "initRecipeCategory",
        ]),
        sendEditedRecipe() {
            const editedRecipeObj = {
                id: this.editingTargetRecipe[0].id,
                editedRecipeName: this.recipeName,
                editedIngredients: this.ingredientList,
            };
            this.editedRecipeObj = editedRecipeObj;
            document.editRecipeForm.action = `/users/${this.userId}/recipes/update`;
            document.editRecipeForm.submit();
        },
        addIngredient() {
            if (this.ingredient == null) {
                alert("食材を選択してください");
                return;
            }
            this.setIngredientList({
                ingredient: this.ingredient,
                editingIngredientIndex: this.editingIngredientIndex,
            });
            this.initIngredient();
        },
        editIngredient(ingredient, index) {
            this.setIngredient(ingredient);
            this.setIsEditingIngredient();
            this.setEditingIngredientIndex(index);
        },
        deleteIngredient(index) {
            this.deleteIngredient(index);
        },
        addRecipeProcedure() {
            if (this.isEditingRecipeProcedure == true) {
                this.recipeProcedureList.splice(
                    this.editingRecipeProcedureIndex,
                    1,
                    this.recipeProcedureInputField
                );
                this.isEditingRecipeProcedure = false;
                this.recipeProcedureInputField = "";
                return;
            }

            if (this.recipeProcedureInputField == "") {
                alert("作り方を入力してください。");
                return;
            }

            this.recipeProcedureList.push(this.recipeProcedureInputField);
            this.recipeProcedureInputField = "";
            document.getElementById("recipe-procedure-input-field").focus();
        },
        editRecipeProcedure(recipeProcedure, index) {
            this.recipeProcedureInputField = recipeProcedure;
            this.isEditingRecipeProcedure = true;
            this.editingRecipeProcedureIndex = index;
        },
        deleteRecipeProcedure(index) {
            this.recipeProcedureList.splice(index, 1);
        },
        returnToPreviousPage: function () {
            history.back();
        },
    },
};
</script>
