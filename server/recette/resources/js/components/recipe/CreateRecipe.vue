<template>
    <section class="recipe-detail-section">
        <i @click="returnToPreviousPage()" class="fas fa-angle-left fa-lg"></i>
        <!-- <h4>レシピ新規登録</h4> -->

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
                name="newRecipe"
                :value="JSON.stringify(newRecipe)"
            />
            <div class="meal-container__recipe-deatail">
                <ImagePreview />
            </div>
            <div class="recipe-container__recipe-deatail">
                <div class="mb-3 d-flex">
                    <label class="mb-0">レシピ名：</label>
                    <input
                        class="text-input"
                        type="text"
                        id="recipe-name"
                        v-model="recipeName"
                    />
                </div>
            </div>

            <p class="ingredient-title__recipe-detail">材料</p>
            <div class="ingredient-container__recipe-deatail">
                <ul
                    class="pl-1"
                    v-for="(ingredient, index) in ingredientList"
                    :key="ingredient.id"
                >
                    <li>
                        {{ ingredient.ingredient_name }}
                        <!-- <span>{{
                            ingredient.ingredient.ingredient_category
                        }}</span
                        > -->
                        <span class=""
                            ><i
                                @click="editIngredient(ingredient, index)"
                                class="ml-2 fas fa-pencil-alt"
                            ></i
                        ></span>
                        <span class=""
                            ><i
                                @click="deleteIngredient(index)"
                                class="ml-2 fas fa-trash-alt"
                            ></i
                        ></span>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <select
                        v-model="ingredient"
                        class="custom-select mr-2"
                        aria-label="Default select example"
                    >
                        <!-- <option selected>Open this select menu</option> -->
                        <option
                            v-for="ingredient in ingredients"
                            :value="ingredient"
                            :key="ingredient.id"
                        >
                            {{ ingredient.ingredient_name }}
                        </option>
                    </select>
                    <i
                        @click.prevent="addIngredient(ingredient)"
                        class="far fa-check-circle fa-2x"
                    ></i>
                </div>
                <div class="ingredient-description__recipe-deatail">
                    <!-- <div class="form-group">
                        <input
                            class="p-1 form-control"
                            type="text"
                            id="price"
                            name="ingredient_name"
                        />
                    </div> -->
                </div>
            </div>

            <div class="recipe-container__recipe-deatail">
                <div class="d-flex justify-content-between">
                    <p class="recipe-title__recipe-detail">作り方</p>
                    <p class="text-right mb-0">
                        <i class="fas fa-external-link-square-alt"></i>レシピURL
                    </p>
                </div>
                <div class="recipe-description__recipe-deatail p-2">
                    <ul
                        class="pl-1"
                        v-for="(recipeProcedure, index) in recipeProcedureList"
                        :key="recipeProcedure.toString(index)"
                    >
                        <li>{{ index + 1 }}.{{ recipeProcedure }}</li>
                    </ul>
                    <div class="form-group">
                        <textarea
                            v-model="recipeProcedureInputField"
                            class="form-control mx-auto"
                            id="recipe-procedure-input-field"
                            rows="2"
                        ></textarea>
                    </div>

                    <p class="text-right">
                        <i
                            @click="addRecipeProcedure()"
                            class="mr-1 fas fa-plus"
                        ></i
                        >追加
                    </p>
                </div>
            </div>
            <PrimaryButton
                :buttonName="'登録する'"
                :propsFunc="showRecipeDetail"
                :buttonStyle="addRecipeButtonStyle"
            />

            <!-- <button @click="showRecipeDetail()">登録する</button> -->
        </form>
    </section>
</template>

<script>
import ImagePreview from "../parts/ImagePreview";
import PrimaryButton from "../parts/PrimaryButton";

export default {
    name: "CreateRecipe",
    props: ["ingredients"],
    components: {
        ImagePreview,
        PrimaryButton,
    },
    data() {
        return {
            recipeName: "",
            ingredient: "",
            ingredientList: [],
            recipeProcedureInputField: "",
            recipeProcedureList: [],
            editing: false,
            editingIngredientIndex: 0,
            addRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "10px",
                flexBasis: "70%",
                width: "100%",
            },
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        newRecipe() {
            const newRecipe = {
                recipeName: this.recipeName,
                ingredients: this.ingredientList,
                recipeProcedure: this.recipeProcedureList,
            };
            return newRecipe;
        },
    },
    mounted() {},
    methods: {
        showRecipeDetail: function () {
            const userId = this.$store.state.userId;
            document.createRecipeForm.action = `/users/${userId}/recipes/store`;
            document.createRecipeForm.submit();
        },
        addIngredient(ingredient) {
            console.log(this.editing);
            if (this.editing == true) {
                this.ingredientList.splice(
                    this.editingIngredientIndex,
                    1,
                    ingredient
                );
                this.editing = false;
                console.log(this.ingredientList);
                return;
            }
            this.ingredientList.push(ingredient);
            this.ingredient = "";
        },
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];

            location.pathname =
                "/users/" + userId + "/recipes/" + "edit/" + recipeId;
        },
        editIngredient(ingredient, index) {
            this.ingredient = ingredient;
            this.editing = true;
            this.editingIngredientIndex = index;
        },
        deleteIngredient: function (index) {
            this.ingredientList.splice(index, 1);
        },
        addRecipeProcedure() {
            this.recipeProcedureList.push(this.recipeProcedureInputField);
            this.recipeProcedureInputField = "";
            document.getElementById("recipe-procedure-input-field").focus();
        },
    },
};
</script>
