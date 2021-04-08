<template>
    <section class="section-recipe_edit">
        <div class="wrapper-recipe_edit">
            <ReturnButton :props-function="routerBack" />

            <!-- ぱんくずリスト -->

            <!-- <BreadCrumb
                class="breadcrumb-component"
                :bread-crumb-list="breadCrumbList"
            /> -->

            <!-- <ImagePreview :title="'レシピ画像UL'" /> -->

            <!-- レシピ画像 -->
            <div class="d-flex justify-content-between">
                <img :src="url" class="w-50" />
                <div class="d-flex justify-content-end w-50">
                    <label>
                        <i class="fas fa-file-upload mr-1"></i>
                        <span class="small">{{ "レシピ画像選択" }}</span>
                        <input
                            class="d-none"
                            name="imagefile"
                            id="imagefile"
                            type="file"
                            ref="preview"
                            @change="uploadFile($event)"
                        />
                    </label>
                </div>
            </div>

            <div
                class="container-recipe_name-recipe_edit mb-4 d-flex mt-2 align-items-end"
            >
                <label class="mb-0">レシピ名：</label>
                <input
                    class="text-input-black"
                    type="text"
                    id="recipe-name"
                    v-model="recipeName"
                />
            </div>

            <div class="mb-4">
                <p class="mb-0">材料</p>
                <div class="container-recipe_ingredient-recipe_edit">
                    <ul
                        class="pl-1"
                        v-for="(
                            recipeIngredient, index
                        ) in recipeIngredientList"
                        :key="recipeIngredient.id"
                    >
                        <li>
                            {{ recipeIngredient.recipe_ingredient_name }}
                            {{ recipeIngredient.recipe_ingredient_quantity }}
                            <span
                                ><i
                                    @click="
                                        editRecipeIngredient(ingredient, index)
                                    "
                                    class="ml-2 fas fa-pencil-alt"
                                ></i
                            ></span>
                            <span
                                ><i
                                    @click="_deleteRecipeIngredient(index)"
                                    class="ml-2 fas fa-trash-alt"
                                ></i
                            ></span>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <select
                            v-model="recipeIngredient"
                            class="custom-select mr-1"
                        >
                            <option
                                v-for="ingredient in ingredients"
                                :value="ingredient"
                                :key="ingredient.id"
                            >
                                {{ ingredient.recipe_ingredient_name }}
                            </option>
                        </select>
                        <TextInput
                            :id="'input-recipe-ingredient-quantity'"
                            :type="'text'"
                            :value="recipeIngredientQuantity"
                            :className="'text-input-white'"
                            :placeholder="'数量(単位含む)'"
                            @inputFormContent="
                                recipeIngredientQuantity = $event
                            "
                        />
                        <i
                            @click.prevent="addRecipeIngredient"
                            class="fas fa-check-circle"
                            style="font-size: 1.5rem"
                        ></i>
                    </div>
                </div>
            </div>

            <div class="container-recipe_procedure mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>
                    <span class="small">
                        <i class="mr-1 fas fa-book-open"></i>レシピURL
                    </span>
                </div>
                <div class="container-recipe_procedure-recipe_edit p-2">
                    <ul
                        class="pl-1"
                        v-for="(recipeProcedure, index) in recipeProcedureList"
                        :key="recipeProcedure"
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

            <div class="mb-4">
                <p class="mb-0">カテゴリー</p>
                <div class="container-recipe_category-recipe_edit">
                    <div class="input-group mb-3">
                        <select
                            v-model="recipeCategory"
                            class="custom-select mr-1"
                        >
                            <option
                                v-for="category in categories"
                                :value="category"
                                :key="category.id"
                            >
                                {{ category.recipe_category_name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <PrimaryButton
                :buttonName="'登録する'"
                :props-function="sendEditedRecipe"
                :buttonStyle="addRecipeButtonStyle"
            />
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import ImagePreview from "../parts/ImagePreview";
import ReturnButton from "../parts/ReturnButton";
import BreadCrumb from "../common/BreadcrumbTrail";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        PrimaryButton,
        TextInput,
        ImagePreview,
        ReturnButton,
        BreadCrumb,
    },
    name: "EditRecipe",
    mixins: [utilsMixin],
    props: ["recipeId"],
    data() {
        return {
            breadCrumbList: [
                { id: 1, name: "ホーム", linkName: "recipes" },
                { id: 2, name: "レシピ作成", linkName: "createRecipe" },
                { id: 3, name: "レシピ編集", linkName: "editRecipe" },
            ],
            editedRecipeObj: null,
            file: null,
            url: null,
            addRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "10px",
                height: "35px",
                width: "100%",
            },
            categories: [
                {
                    recipe_category_name: "肉料理",
                    recipe_category_name_sub: "meat",
                    recipe_category_image: "/images/肉料理.jpeg",
                },
                {
                    recipe_category_name: "魚料理",
                    recipe_category_name_sub: "fish",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "野菜料理",
                    recipe_category_name_sub: "veg",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "麺類",
                    recipe_category_name_sub: "noodle",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "ご飯もの",
                    recipe_category_name_sub: "rice",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "スープ、汁物",
                    recipe_category_name_sub: "soup",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "パン類",
                    recipe_category_name_sub: "bread",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "お菓子",
                    recipe_category_name_sub: "sweets",
                    recipe_category_image: "",
                },
                {
                    recipe_category_name: "そのほか",
                    recipe_category_name_sub: "other",
                    recipe_category_image: "",
                },
            ],
        };
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
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
        editedRecipe() {
            const editedRecipe = {
                id: this.selectedRecipe[0].id,
                recipeName: this.recipeName,
                recipeIngredientList: this.recipeIngredientList,
                recipeProcedure: this.recipeProcedureList,
                recipeCategory: this.recipeCategory,
            };
            return editedRecipe;
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
        recipeCategory: {
            get() {
                return this.$store.getters.getrecipeCategory;
            },
            set(val) {
                this.setRecipeCategory(val);
            },
        },
        recipeIngredientQuantity: {
            get() {
                return this.$store.getters.getRecipeIngredientQuantity;
            },
            set(val) {
                this.setRecipeIngredientQuantity(val);
            },
        },
    },
    created() {},
    mounted() {
        this.initRecipeIngredientQuantity();
        this.initRecipeProcedureList();
        this.selectedRecipe[0].recipe_procedure.forEach((recipe_procedure) => {
            this.setRecipeProcedureList(recipe_procedure);
        });

        console.log(this.selectedRecipe);
        const categoryObj = {
            recipe_category_name: this.selectedRecipe[0].recipe_category,
            recipe_category_name_sub: this.selectedRecipe[0]
                .recipe_category_sub,
            recipe_category_image: this.selectedRecipe[0].recipe_category_image,
        };
        this.setRecipeCategory(categoryObj);
        this.recipeName = this.selectedRecipe[0].recipe_name;
        this.ingredientList = this.ingredients;
        this.initRecipeIngredientList();
        console.log(this.selectedRecipe[0].recipe_ingredients);
        this.selectedRecipe[0].recipe_ingredients.forEach(
            (recipe_ingredient) => {
                this.setRecipeIngredientList({
                    recipeIngredient: recipe_ingredient,
                    recipeIngredientQuantity:
                        recipe_ingredient.recipe_ingredient_quantity,
                });
            }
        );
        // console.log(this.);
        this.url = this.selectedRecipe[0].recipe_image_path;
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
            "setRecipeIngredientQuantity",
            "initRecipeIngredientQuantity",
        ]),
        sendEditedRecipe() {
            if (this.recipeName == "") {
                alert("レシピ名は必須です");
                return;
            }

            const url =
                "/api/users/" +
                this.userData.userId +
                "/recipes/" +
                this.recipeId +
                "/edit";
            let formData = new FormData();
            const file = document.getElementById("imagefile");
            formData.append("file", file.files[0]);
            formData.append("editedRecipe", JSON.stringify(this.editedRecipe));
            console.log(this.editedRecipe);

            axios
                .post(
                    url,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                            "X-HTTP-Method-Override": "PUT",
                        },
                    }
                    // newRecipe: JSON.stringify(this.newRecipe),
                )
                .then((res) => {
                    console.log(res);
                    this.$router.push({ name: "recipes" });
                    this.initRecipeIngredientList();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addRecipeIngredient() {
            if (this.recipeIngredient == null) {
                alert("食材を選択してください");
                return;
            }

            this.setRecipeIngredientList({
                recipeIngredient: this.recipeIngredient,
                recipeIngredientQuantity: this.recipeIngredientQuantity,
            });
            this.initRecipeIngredient();
            this.initRecipeIngredientQuantity();
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
            if (this.recipeProcedure == "") {
                alert("作り方を入力してください。");
                return;
            }

            // 追加 or 編集の分岐はmutatiion側で判定
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
            this.deleteRecipeProcedure(index);
        },
        returnToPreviousPage: function () {
            history.back();
        },
        uploadFile(e) {
            this.file = e.target.files[0];
            this.url = URL.createObjectURL(this.file);
            console.log(this.url);
        },
    },
};
</script>
