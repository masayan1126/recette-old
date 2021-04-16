<template>
    <section class="section-recipe_edit">
        <div class="wrapper-recipe_edit">
            <ReturnButton :props-function="routerBack" />
            <Modal
                :input-contents="contents.inputContents"
                :input-style="style.inputContentsStyle"
                :image-preview-contents="
                    contents.imagePreviewContentsForRecipeUrl
                "
                :modal-contents="contents.modalContents"
                :modal-style="style.modalStyle"
                :modal-set-function="contents.modalContents.modalSetFunction"
                :modal-submit-function="
                    contents.modalContents.modalSubmitFunction
                "
                :unnecessary-element-style="style.unnecessaryElementStyle"
            />

            <!-- レシピ画像 -->
            <div class="d-lg-flex justify-content-between">
                <div class="w-100 w-lg-49">
                    <ImagePreview
                        :image-preview-contents="
                            contents.imagePreviewContentsForRecipeImage
                        "
                    />
                </div>
                <div class="w-100 mb-4 d-none d-md-block w-lg-49">
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
                                {{
                                    recipeIngredient.recipe_ingredient_quantity
                                }}
                                <span
                                    ><i
                                        @click="
                                            editRecipeIngredient(
                                                ingredient,
                                                index
                                            )
                                        "
                                        class="ml-2 fas fa-pencil-alt"
                                    ></i
                                ></span>
                                <span
                                    ><i
                                        @click="deleteRecipeIngredient(index)"
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
                                :class-name="'text-input-white'"
                                :id="'input-recipe-ingredient-quantity'"
                                :placeholder="'例)1枚、1本'"
                                @inputFormContent="
                                    recipeIngredientQuantity = $event
                                "
                                :type="'text'"
                                :value="recipeIngredientQuantity"
                            />
                            <i
                                @click.prevent="addRecipeIngredient"
                                class="fas fa-check-circle"
                                style="font-size: 1.5rem"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-md-flex">
                <div
                    class="container-recipe_name-recipe_edit mb-4 d-flex mt-2 align-items-end"
                >
                    <label class="mb-0">レシピ名：</label>
                    <input
                        class="text-input-black w-75"
                        type="text"
                        id="recipe-name"
                        v-model="recipeName"
                    />
                </div>

                <div class="mb-4 d-md-none" style="flex-basis: 50%">
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
                                {{
                                    recipeIngredient.recipe_ingredient_quantity
                                }}
                                <span
                                    ><i
                                        @click="
                                            editRecipeIngredient(
                                                ingredient,
                                                index
                                            )
                                        "
                                        class="ml-2 fas fa-pencil-alt"
                                    ></i
                                ></span>
                                <span
                                    ><i
                                        @click="deleteRecipeIngredient(index)"
                                        class="ml-2 fas fa-trash-alt"
                                    ></i
                                ></span>
                            </li>
                        </ul>
                        <div
                            class="d-flex align-items-center justify-content-between"
                        >
                            <select
                                v-model="recipeIngredient"
                                class="custom-select mr-1 w-50"
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
                                :class-name="'text-input-white w-30'"
                                :id="'input-recipe-ingredient-quantity'"
                                @inputFormContent="
                                    recipeIngredientQuantity = $event
                                "
                                :placeholder="'例)1枚、1本'"
                                :type="'text'"
                                :value="recipeIngredientQuantity"
                            />
                            <i
                                @click.prevent="addRecipeIngredient"
                                class="fas fa-check-circle w-10"
                                style="font-size: 1.5rem"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-md-flex justify-content-between">
                <div class="mb-4 mb-md-0 w-md-65">
                    <div class="d-flex justify-content-between align-items-end">
                        <span>作り方</span>
                        <span
                            class="cursor-pointer color-link_menu"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            v-if="selectedRecipe[0].recipe_url != null"
                        >
                            <i class="mr-1 fas fa-book-open"></i>レシピURL
                        </span>
                        <!-- URlの登録がない場合は↓を表示 -->
                        <span
                            v-else
                            class="cursor-pointer"
                            data-toggle="modal"
                            data-target="#exampleModal"
                        >
                            <i class="mr-1 fas fa-book-open"></i>レシピURL
                        </span>
                    </div>
                    <div class="container-recipe_procedure-recipe_edit p-2">
                        <ul
                            class="pl-1"
                            v-for="(
                                recipeProcedure, index
                            ) in recipeProcedureList"
                            :key="recipeProcedure"
                        >
                            <li>
                                {{ index + 1 }}.{{ recipeProcedure
                                }}<i
                                    @click="
                                        editRecipeProcedure(
                                            recipeProcedure,
                                            index
                                        )
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

                <div class="w-md-30 d-md-flex flex-column">
                    <div class="mb-4">
                        <p class="mb-0">調理時間</p>
                        <div class="container-recipe_category-recipe_edit">
                            <div class="input-group mb-3">
                                <select
                                    v-model="cookingTime"
                                    class="custom-select mr-1"
                                >
                                    <option
                                        v-for="cookingTime in cookingTimeList"
                                        :value="cookingTime"
                                        :key="cookingTime.index"
                                    >
                                        {{ cookingTime.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="mb-0">ジャンル</p>
                        <div class="container-recipe_category-recipe_edit">
                            <div class="input-group mb-3">
                                <select
                                    v-model="recipeGenre"
                                    class="custom-select mr-1"
                                >
                                    <option
                                        v-for="recipeGenre in recipeGenres"
                                        :value="recipeGenre"
                                        :key="recipeGenre.index"
                                    >
                                        {{ recipeGenre.name }}
                                    </option>
                                </select>
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
                        class="mt-auto"
                        :button-name="'登録する'"
                        :button-style="style.addRecipeButtonStyle"
                        :props-function="sendEditedRecipe"
                    />
                </div>
            </div>

            <!--  -->
        </div>
    </section>
</template>

<script>
import CookingTimeList from "../../assets/cookingTimeList";
import ImagePreview from "../parts/ImagePreview";
import { mapGetters, mapMutations, mapActions } from "vuex";
import Modal from "../parts/Modal";
import PrimaryButton from "../parts/PrimaryButton";
import RecipeCategories from "../../assets/recipeCategories";
import RecipeGenres from "../../assets/recipeGenres";
import ReturnButton from "../parts/ReturnButton";
import TextInput from "../parts/TextInput";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        ImagePreview,
        Modal,
        PrimaryButton,
        ReturnButton,
        TextInput,
    },
    mixins: [utilsMixin],
    name: "EditRecipe",
    props: ["recipeId"],
    data() {
        return {
            categories: RecipeCategories.categories,
            cookingTimeList: CookingTimeList.cookingTimeList,
            recipeGenres: RecipeGenres.recipeGenres,
            contents: {
                imagePreviewContentsForRecipeImage: {
                    defaultImage: null,
                    fileId: "recipe-image-file",
                    fileName: "recipe-image-file",
                    uploadLinkTitle: "レシピ画像選択",
                },
                imagePreviewContentsForRecipeUrl: {
                    defaultImage: null,
                    fileId: "file",
                    fileName: "file",
                    uploadLinkTitle: "",
                },
                inputContents: {
                    label: {
                        one: { id: "primary-input-recipe-url", name: "URL1" },
                        two: {},
                    },
                    input: {
                        one: {
                            id: "primary-input-recipe-url",
                            value: "",
                            type: "text",
                        },
                        two: {},
                    },
                },
                modalContents: {
                    modalTitle: "レシピURLの登録",
                    modalSetFunction: null,
                    modalSubmitFunction: null,
                },
            },
            style: {
                addRecipeButtonStyle: {
                    color: "#fff",
                    backgroundColor: "#E4C8AD",
                    fontSize: "10px",
                    height: "35px",
                    width: "100%",
                },
                inputContentsStyle: {
                    width: "100%",
                },
                modalStyle: {
                    backgroundColor: "#454545",
                },
                unnecessaryElementStyle: {
                    display: "none !important",
                },
            },
        };
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
            ingredients: "getIngredients",
            recipeIngredientList: "getRecipeIngredientList",
            recipeProcedureList: "getRecipeProcedureList",
        }),
        cookingTime: {
            get() {
                return this.$store.getters.getCookingTime;
            },
            set(val) {
                this.setCookingTime(val);
            },
        },
        editedRecipe() {
            const editedRecipe = {
                cookingTime: this.cookingTime,
                id: this.selectedRecipe[0].id,
                recipeName: this.recipeName,
                recipeCategory: this.recipeCategory,
                recipeGenre: this.recipeGenre,
                recipeIngredientList: this.recipeIngredientList,
                recipeProcedure: this.recipeProcedureList,
                recipeUrl: this.contents.inputContents.input.one.value,
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
        recipeIngredient: {
            get() {
                return this.$store.getters.getRecipeIngredient;
            },
            set(val) {
                this.setRecipeIngredient(val);
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
        recipeGenre: {
            get() {
                return this.$store.getters.getRecipeGenre;
            },
            set(val) {
                this.setRecipeGenre(val);
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
        recipeProcedure: {
            get() {
                return this.$store.getters.getRecipeProcedure;
            },
            set(val) {
                this.setRecipeProcedure(val);
            },
        },
        selectedRecipe() {
            return this.recipes.filter((recipe) => recipe.id == this.recipeId);
        },
    },
    created() {
        this.initStoreDataSet();
        this.setSelectedRecipeData();
    },
    methods: {
        ...mapMutations([
            "deleteRecipeIngredient",
            "deleteRecipeProcedure",
            "initRecipeName",
            "initRecipeIngredient",
            "initRecipeIngredientList",
            "initIsEditingRecipeIngredient",
            "initEditingRecipeIngredientIndex",
            "initRecipeProcedure",
            "initRecipeProcedureList",
            "initIsEditingRecipeProcedure",
            "initEditingRecipeProcedureIndex",
            "initRecipeCategory",
            "initRecipeIngredientQuantity",
            "initRecipeGenre",
            "initCookingTime",
            "setRecipeName",
            "setIngredients",
            "setRecipeIngredient",
            "setRecipeIngredientQuantity",
            "setRecipeIngredientList",
            "setIsEditingRecipeIngredient",
            "setEditingRecipeIngredientIndex",
            "setRecipeProcedure",
            "setRecipeProcedureList",
            "setIsEditingRecipeProcedure",
            "setEditingRecipeProcedureIndex",
            "setRecipeCategory",
            "setRecipeGenre",
            "setCookingTime",
        ]),
        ...mapActions(["setRecipes"]),
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
        addRecipeProcedure() {
            if (this.recipeProcedure == null) {
                alert("作り方を入力してください。");
                return;
            }

            // 追加 or 編集の分岐はmutatiion側で判定
            this.setRecipeProcedureList(this.recipeProcedure);
            this.initRecipeProcedure();
            document.getElementById("recipe-procedure-input-field").focus();
        },
        editRecipeIngredient(ingredient, index) {
            this.setRecipeIngredientQuantity(
                ingredient.recipeIngredientQuantity
            );
            this.setRecipeIngredient(ingredient);
            // 食材編集モードをtrueに
            this.setIsEditingRecipeIngredient();
            this.setEditingRecipeIngredientIndex(index);
        },

        editRecipeProcedure(recipeProcedure, index) {
            this.setRecipeProcedure(recipeProcedure);
            this.setIsEditingRecipeProcedure();
            this.setEditingRecipeProcedureIndex(index);
        },
        initStoreDataSet() {
            this.initRecipeIngredientList();
            this.initRecipeProcedureList();
        },
        sendEditedRecipe() {
            if (this.recipeName == null) {
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
            const file = document.getElementById("recipe-image-file");
            formData.append("recipe-image-file", file.files[0]);
            formData.append("editedRecipe", JSON.stringify(this.editedRecipe));

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-HTTP-Method-Override": "PUT",
                    },
                })
                .then((res) => {
                    console.log(res.data);
                    this.setRecipes(res.data);
                    console.log(this.recipes);
                    this.$router.push({
                        name: "recipeDetail",
                        params: { recipeId: this.recipeId },
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setSelectedRecipeData() {
            this.setRecipeName(this.selectedRecipe[0].recipe_name);

            this.selectedRecipe[0].recipe_ingredients.forEach(
                (recipe_ingredient) => {
                    this.setRecipeIngredientList({
                        recipeIngredient: recipe_ingredient,
                        recipeIngredientQuantity:
                            recipe_ingredient.recipe_ingredient_quantity,
                    });
                }
            );

            this.selectedRecipe[0].recipe_procedure.forEach(
                (recipe_procedure) => {
                    this.setRecipeProcedureList(recipe_procedure);
                }
            );

            this.contents.imagePreviewContentsForRecipeImage.defaultImage = this.selectedRecipe[0].recipe_image_path;
            const selectedRecipeCategory = {
                recipe_category_name: this.selectedRecipe[0].recipe_category,
                recipe_category_name_sub: this.selectedRecipe[0]
                    .recipe_category_sub,
                recipe_category_image: this.selectedRecipe[0]
                    .recipe_category_image,
            };

            this.setRecipeCategory(selectedRecipeCategory);

            const selectedRecipeCookingTime = this.cookingTimeList.filter(
                (cookingTimeObj) =>
                    cookingTimeObj.index ==
                    this.selectedRecipe[0].cooking_time_index
            );
            this.setCookingTime(selectedRecipeCookingTime[0]);

            const selectedRecipeGenre = this.recipeGenres.filter(
                (recipeGenreObj) =>
                    recipeGenreObj.index ==
                    this.selectedRecipe[0].recipe_genre_index
            );

            this.setRecipeGenre(selectedRecipeGenre[0]);

            this.contents.inputContents.input.one.value = this.selectedRecipe[0].recipe_url;
        },
    },
};
</script>
