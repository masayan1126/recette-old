<template>
    <section class="section-recipe_create">
        <div class="wrapper-recipe_create">
            <i @click="goToPreviousPage" class="fas fa-angle-left fa-2x"></i>
            <Toast
                :is-show="isShow"
                :is-hide="isHide"
                :props-function="addInitialIngredients"
            />

            <ImagePreview
                :title="'レシピ画像UL'"
                :recipe-image-path="'https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png'"
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
                            {{ ingredient.ingredient_name }}
                            <span
                                ><i
                                    @click="editIngredient(ingredient, index)"
                                    class="ml-2 fas fa-pencil-alt"
                                ></i
                            ></span>
                            <span
                                ><i
                                    @click="_deleteIngredient(index)"
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
                        v-for="(recipeProcedure, index) in recipeProcedureList"
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
                                @click="_deleteRecipeProcedure(index)"
                                class="ml-2 fas fa-trash-alt"
                            ></i>
                        </li>
                    </ul>
                    <div class="form-group">
                        <textarea
                            v-model="recipeProcedure"
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
                name="createRecipeForm"
            >
                <input type="hidden" name="_token" :value="csrf" />
                <input
                    type="hidden"
                    name="newRecipe"
                    :value="JSON.stringify(newRecipe)"
                />
                <PrimaryButton
                    :buttonName="'登録する'"
                    :props-function="sendNewRecipe"
                    :buttonStyle="sendNewRecipeButtonStyle"
                />
            </form>
        </div>
    </section>
</template>

<script>
import ImagePreview from "../parts/ImagePreview";
import PrimaryButton from "../parts/PrimaryButton";
import Toast from "../parts/Toast";
import initialIngredientList from "../../assets/initialIngredientList.json";
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "CreateRecipe",
    props: ["ingredients"],
    components: {
        ImagePreview,
        PrimaryButton,
        Toast,
    },
    data() {
        return {
            isShow: false,
            isHide: false,
            sendNewRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
            ingredientList: "getIngredientList",
            isEditingIngredient: "getIsEditingIngredient",
            editingIngredientIndex: "getEditingIngredientIndex",
            recipeProcedureList: "getRecipeProcedureList",
            isEditingRecipeProcedure: "getIsEditingRecipeProcedure",
            editingRecipeProcedureIndex: "getEditingRecipeProcedureIndex",
        }),
        newRecipe() {
            const newRecipe = {
                recipeName: this.recipeName,
                ingredients: this.ingredientList,
                recipeProcedure: this.recipeProcedureList,
            };
            return newRecipe;
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
        recipeProcedure: {
            get() {
                return this.$store.getters.getRecipeProcedure;
            },
            set(val) {
                this.setRecipeProcedure(val);
            },
        },
    },
    mounted() {
        console.log(this.userId, this.ingredientList);
        this.initRecipeName();
        this.initIngredient();
        this.initIngredientList();
        this.initIsEditingIngredient();
        this.initEditingIngredientIndex();
        this.initRecipeProcedure();
        this.initRecipeProcedureList();
        this.initIsEditingRecipeProcedure();
        this.initEditingRecipeProcedureIndex();

        this.ingredients.length == 0
            ? (this.isShow = true)
            : (this.isHide = true);
    },
    methods: {
        ...mapMutations([
            "setRecipeName",
            "initRecipeName",
            "setIngredient",
            "initIngredient",
            "deleteIngredient",
            "setIngredientList",
            "initIngredientList",
            "setIsEditingIngredient",
            "initIsEditingIngredient",
            "setEditingIngredientIndex",
            "initEditingIngredientIndex",
            "setRecipeProcedure",
            "initRecipeProcedure",
            "setRecipeProcedureList",
            "initRecipeProcedureList",
            "setIsEditingRecipeProcedure",
            "initIsEditingRecipeProcedure",
            "setEditingRecipeProcedureIndex",
            "initEditingRecipeProcedureIndex",
            "deleteRecipeProcedure",
        ]),

        sendNewRecipe() {
            if (this.recipeName == "") {
                alert("レシピ名は必須です");
                return;
            }
            this.initIngredientList();
            document.createRecipeForm.action = `/users/${this.userId}/recipes/store`;
            document.createRecipeForm.submit();
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
        _deleteIngredient(index) {
            console.log(index);
            this.deleteIngredient(index);
        },
        addRecipeProcedure() {
            if (this.recipeProcedure == "") {
                alert("作り方を入力してください。");
                return;
            }

            this.setRecipeProcedureList(this.recipeProcedure);
            this.initRecipeProcedure();
            document.getElementById("recipe-procedure-input-field").focus();
        },
        editRecipeProcedure(recipeProcedure, index) {
            this.setRecipeProcedure(recipeProcedure);
            this.setIsEditingRecipeProcedure();
            this.setEditingRecipeProcedureIndex(index);
        },
        _deleteRecipeProcedure(index) {
            console.log(index);
            this.deleteRecipeProcedure(index);
        },
        addInitialIngredients() {
            axios
                .post("/api/users/" + this.userId + "/ingredients/add", {
                    initialIngredientList: JSON.stringify(
                        initialIngredientList
                    ),
                })
                .then(function (res) {
                    console.log(res);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        goToPreviousPage() {
            this.$store.commit(
                "goToPreviousPage",
                `/users/${this.userId}/recipes`
            );
        },
        goToRecipeEditScreen: function () {
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];

            location.pathname =
                "/users/" + this.userId + "/recipes/" + "edit/" + recipeId;
        },
    },
};
</script>
