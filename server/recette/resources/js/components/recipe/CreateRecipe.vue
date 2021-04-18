<template>
    <section class="section-recipe_create">
        <div class="wrapper-recipe_create">
            <ReturnButton :props-function="routerBack" />
            <Toast :toast-contents="contents.toastContents" />
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

            <!-- 画像アップロード -->
            <ImagePreview
                :image-preview-contents="
                    contents.imagePreviewContentsForRecipeImage
                "
            />

            <div
                class="container-recipe_name-recipe_create mb-4 d-flex mt-2 align-items-end"
            >
                <InputLabel
                    :class-name="'mb-0'"
                    :id="'input-recipe-name'"
                    :name="'レシピ名：'"
                />
                <TextInput
                    :class-name="'text-input-black w-60'"
                    :id="'input-recipe-name'"
                    @inputFormContent="recipeName = $event"
                    :type="'text'"
                    :value="recipeName"
                />
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">材料</p>
                    <router-link
                        class="font_size-resize"
                        :to="{
                            name: 'ingredientList',
                        }"
                    >
                        追加したい食材がない場合はこちら
                    </router-link>
                </div>
                <div class="container-recipe_ingredient-recipe_create">
                    <ul
                        class="pl-1"
                        v-for="(
                            recipeIngredient, index
                        ) in recipeIngredientList"
                        :key="recipeIngredient.id"
                    >
                        <li>
                            {{ recipeIngredient.ingredient_name }}
                            {{ recipeIngredient.ingredient_quantity }}
                            <span
                                ><i
                                    @click="
                                        editRecipeIngredient(
                                            recipeIngredient,
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
                            class="custom-select w-60"
                            v-model="recipeIngredient"
                        >
                            <option
                                v-for="ingredient in ingredients"
                                :value="ingredient"
                                :key="ingredient.id"
                            >
                                {{ ingredient.ingredient_name }}
                            </option>
                        </select>
                        <TextInput
                            :class-name="'w-30 text-input-white'"
                            :id="'input-recipe-ingredient-quantity'"
                            @inputFormContent="
                                recipeIngredientQuantity = $event
                            "
                            :placeholder="'例)1枚、1本'"
                            :type="'text'"
                            :value="recipeIngredientQuantity"
                        />
                        <i
                            class="fas fa-check-circle"
                            @click="addRecipeIngredient"
                            style="font-size: 1.5rem"
                        ></i>
                    </div>
                </div>
            </div>

            <div class="mb-4 d-md-flex justify-content-between">
                <div class="w-100 w-md-65 mb-4 mb-md-0">
                    <div class="d-flex justify-content-between align-items-end">
                        <span>作り方</span>
                        <span
                            class="cursor-pointer font_size-resize"
                            :data-target="`#${contents.modalContents.modalId}`"
                            data-toggle="modal"
                        >
                            <i class="mr-1 fas fa-book-open"></i>レシピURL
                        </span>
                    </div>
                    <div class="container-recipe_procedure-recipe_create p-2">
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
                                    class="ml-2 fas fa-pencil-alt"
                                    @click="
                                        editRecipeProcedure(
                                            recipeProcedure,
                                            index
                                        )
                                    "
                                ></i>
                                <i
                                    class="ml-2 fas fa-trash-alt"
                                    @click="deleteRecipeProcedure(index)"
                                ></i>
                            </li>
                        </ul>
                        <div class="form-group">
                            <textarea
                                class="form-control"
                                id="recipe-procedure-input-field"
                                rows="2"
                                v-model="recipeProcedure"
                            ></textarea>
                        </div>

                        <div @click="addRecipeProcedure" class="text-right">
                            <i class="mr-1 fas fa-plus"></i>追加
                        </div>
                    </div>
                </div>
                <div class="w-100 w-md-30 d-md-flex flex-column">
                    <div class="mb-4">
                        <p class="mb-0">調理時間</p>
                        <div
                            class="container-recipe_category-recipe_create d-flex"
                        >
                            <div class="input-group mb-3">
                                <select
                                    class="custom-select mr-1"
                                    v-model="cookingTime"
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
                        <div
                            class="container-recipe_category-recipe_create d-flex"
                        >
                            <div class="input-group mb-3">
                                <select
                                    class="custom-select mr-1"
                                    v-model="recipeGenre"
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
                        <div
                            class="container-recipe_category-recipe_create d-flex"
                        >
                            <div class="input-group mb-3">
                                <select
                                    class="custom-select mr-1"
                                    v-model="recipeCategory"
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
                        :button-style="style.sendNewRecipeButtonStyle"
                        :props-function="sendNewRecipe"
                    />
                </div>
            </div>

            <!--  -->
        </div>
    </section>
</template>

<script>
import ImagePreview from "../parts/ImagePreview";
import InputLabel from "../parts/InputLabel";
import initialIngredientList from "../../assets/initialIngredientList.json";
import CookingTimeList from "../../assets/cookingTimeList";
import RecipeGenres from "../../assets/recipeGenres";
import { mapGetters, mapMutations, mapActions } from "vuex";
import Modal from "../parts/Modal";
import PrimaryButton from "../parts/PrimaryButton";
import RecipeCategories from "../../assets/recipeCategories";
import ReturnButton from "../parts/ReturnButton";
import Toast from "../parts/Toast";
import TextInput from "../parts/TextInput";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        ImagePreview,
        InputLabel,
        Modal,
        PrimaryButton,
        ReturnButton,
        Toast,
        TextInput,
    },
    mixins: [utilsMixin],
    name: "CreateRecipe",
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
                            value: null,
                            type: "text",
                        },
                        two: {},
                    },
                },
                modalContents: {
                    modalId: "create-recipeurl-modal",
                    modalTitle: "レシピURLの登録",
                    modalSetFunction: null,
                    modalSubmitFunction: null,
                },
                toastContents: {
                    toastCloseFunction: this.closeToast,
                    toastIsShow: false,
                    toastSubmitFunction: this.addInitialIngredients,
                    toastTitle: "食材登録",
                },
            },
            style: {
                inputContentsStyle: {
                    width: "100%",
                },
                modalStyle: {
                    backgroundColor: "#454545",
                },
                sendNewRecipeButtonStyle: {
                    color: "#fff",
                    backgroundColor: "#E4C8AD",
                    width: "100%",
                },
                unnecessaryElementStyle: {
                    display: "none !important",
                },
            },
        };
    },
    computed: {
        ...mapGetters({
            ingredients: "getIngredients",
            recipeIngredientList: "getRecipeIngredientList",
            recipeProcedureList: "getRecipeProcedureList",
            userData: "getUserData",
        }),
        cookingTime: {
            get() {
                return this.$store.getters.getCookingTime;
            },
            set(val) {
                this.setCookingTime(val);
            },
        },
        newRecipe() {
            const newRecipe = {
                cookingTime: this.cookingTime,
                recipeCategory: this.recipeCategory,
                recipeGenre: this.recipeGenre,
                recipeIngredientList: this.recipeIngredientList,
                recipeName: this.recipeName,
                recipeProcedure: this.recipeProcedureList,
                recipeUrl: this.contents.inputContents.input.one.value,
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
        recipeCategory: {
            get() {
                return this.$store.getters.getrecipeCategory;
            },
            set(val) {
                this.setRecipeCategory(val);
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
        recipeProcedure: {
            get() {
                return this.$store.getters.getRecipeProcedure;
            },
            set(val) {
                this.setRecipeProcedure(val);
            },
        },
    },
    created() {
        this.initStoreDataSet();
        // 初期データの食材リストが未登録なら、トーストでメッセージを表示する
        this.ingredients.length == 0
            ? (this.contents.toastContents.toastIsShow = true)
            : "";
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
            "initRecipeGenre",
            "initCookingTime",
            "initRecipeIngredientQuantity",
            "setRecipeName",
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
        ...mapActions(["setIngredients"]),
        // 食材の初期データを登録する
        addInitialIngredients() {
            const url =
                "/api/users/" + this.userData.userId + "/ingredients/add";
            axios
                .post(url, {
                    initialIngredientList: JSON.stringify(
                        initialIngredientList
                    ),
                })
                .then((res) => {
                    this.setIngredients(res.data);
                    this.contents.toastContents.toastIsShow = false;
                })
                .catch((error) => {});
        },
        // レシピに必要な食材と数量の入力
        addRecipeIngredient() {
            if (this.recipeIngredient == null) {
                alert("食材を選択してください");
                return;
            }
            // 追加 or 編集の分岐はmutatiion側で判定
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
        closeToast() {
            this.contents.toastContents.toastIsShow = false;
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
            this.initRecipeName();
            this.initRecipeIngredient();
            this.initRecipeIngredientQuantity();
            this.initRecipeIngredientList();
            this.initIsEditingRecipeIngredient();
            this.initEditingRecipeIngredientIndex();
            this.initRecipeProcedure();
            this.initRecipeProcedureList();
            this.initIsEditingRecipeProcedure();
            this.initEditingRecipeProcedureIndex();
            this.initRecipeCategory();
            this.initRecipeGenre();
            this.initCookingTime();
        },
        sendNewRecipe() {
            if (this.recipeName == null) {
                alert("レシピ名は必須です");
                return;
            }

            const url = "/api/users/" + this.userData.userId + "/recipes/add";
            let formData = new FormData();
            const file = document.getElementById("recipe-image-file");
            formData.append("recipe-image-file", file.files[0]);
            formData.append("newRecipe", JSON.stringify(this.newRecipe));

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    this.$router.push({ name: "recipes" });
                })
                .catch((error) => {});
        },
    },
};
</script>
