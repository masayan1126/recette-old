<template>
    <section class="section-recipe_create">
        <div class="wrapper-recipe_create">
            <ReturnButton :props-function="routerBack" />
            <!-- ぱんくずリスト -->
            <!-- <BreadCrumb
                class="breadcrumb-component"
                :bread-crumb-list="breadCrumbList"
            /> -->
            <Toast
                :toast-is-show="toastIsShow"
                :props-function="addInitialIngredients"
            />
            <Modal
                :contents="contents"
                :style="style"
                :props-function="propsFunction"
            />

            <!-- 画像アップロード -->
            <div class="d-flex justify-content-between">
                <img :src="url" class="w-50" />
                <div class="d-flex justify-content-end w-50">
                    <label>
                        <i class="fas fa-file-upload mr-1"></i>
                        <span class="small font_size-md">{{
                            "レシピ画像選択"
                        }}</span>
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
                class="container-recipe_name-recipe_create mb-4 d-flex mt-2 align-items-end"
            >
                <InputLabel
                    class="mb-0"
                    :id="'input-recipe-name'"
                    :name="'レシピ名：'"
                />
                <TextInput
                    class="w-60"
                    :id="'input-recipe-name'"
                    :type="'text'"
                    :value="recipeName"
                    :className="'text-input-black'"
                    @inputFormContent="recipeName = $event"
                />
            </div>
            <div class="mb-4">
                <p class="mb-0">材料</p>
                <div class="container-recipe_ingredient-recipe_create">
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
                                    @click="_deleteRecipeIngredient(index)"
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
                            class="custom-select w-60"
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
                            class="w-30"
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
                            @click="addRecipeIngredient"
                            class="fas fa-check-circle"
                            style="font-size: 1.5rem"
                        ></i>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-end">
                    <span>作り方</span>
                    <span
                        data-toggle="modal"
                        data-target="#exampleModal"
                        class="cursor-pointer"
                    >
                        <i class="mr-1 fas fa-book-open"></i>レシピURL
                    </span>
                </div>
                <div class="container-recipe_procedure-recipe_create p-2">
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

            <div class="mb-4">
                <p class="mb-0">カテゴリー</p>
                <div class="container-recipe_category-recipe_create d-flex">
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
                :props-function="sendNewRecipe"
                :buttonStyle="sendNewRecipeButtonStyle"
            />
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import ImagePreview from "../parts/ImagePreview";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import InputLabel from "../parts/InputLabel";
import Toast from "../parts/Toast";
import initialIngredientList from "../../assets/initialIngredientList.json";
import ReturnButton from "../parts/ReturnButton";
import BreadCrumb from "../common/BreadcrumbTrail";
import utilsMixin from "../../mixin/utility";
import Modal from "../parts/Modal";

export default {
    name: "CreateRecipe",
    props: [],
    mixins: [utilsMixin],
    components: {
        ImagePreview,
        PrimaryButton,
        Toast,
        TextInput,
        InputLabel,
        ReturnButton,
        BreadCrumb,
        Modal,
    },
    data() {
        return {
            sendNewRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
            contents: {
                modalContents: {
                    modalTitle: "レシピURLの登録",
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
            },
            style: {
                modalStyle: {
                    backgroundColor: "#454545",
                },
                inputContentsStyle: {
                    width: "100%",
                },
                unnecessaryElementStyle: {
                    display: "none !important",
                },
            },
            propsFunction: this.initInputValue,
            toastIsShow: false,

            breadCrumbList: [
                { id: 1, name: "ホーム", linkName: "recipes" },
                { id: 2, name: "レシピ作成", linkName: "createRecipe" },
            ],
            file: null,
            url: "/images/no_image.png",
            categories: [
                {
                    id: 1,
                    recipe_category_name: "肉料理",
                    recipe_category_name_sub: "meat",
                    recipe_category_image: "/images/肉料理.jpeg",
                    length: 0,
                },
                {
                    id: 2,
                    recipe_category_name: "魚料理",
                    recipe_category_name_sub: "fish",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 3,
                    recipe_category_name: "野菜料理",
                    recipe_category_name_sub: "veg",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 4,
                    recipe_category_name: "麺類",
                    recipe_category_name_sub: "noodle",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 5,
                    recipe_category_name: "ご飯もの",
                    recipe_category_name_sub: "rice",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 6,
                    recipe_category_name: "スープ、汁物",
                    recipe_category_name_sub: "soup",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 7,
                    recipe_category_name: "パン類",
                    recipe_category_name_sub: "bread",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 8,
                    recipe_category_name: "お菓子",
                    recipe_category_name_sub: "sweets",
                    recipe_category_image: "",
                    length: 0,
                },
                {
                    id: 9,
                    recipe_category_name: "そのほか",
                    recipe_category_name_sub: "other",
                    recipe_category_image: "",
                    length: 0,
                },
            ],
        };
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipeIngredientList: "getRecipeIngredientList",
            isEditingIngredient: "getIsEditingRecipeIngredient",
            editingIngredientIndex: "getEditingRecipeIngredientIndex",
            recipeProcedureList: "getRecipeProcedureList",
            isEditingRecipeProcedure: "getIsEditingRecipeProcedure",
            editingRecipeProcedureIndex: "getEditingRecipeProcedureIndex",
            ingredients: "getIngredients",
        }),
        newRecipe() {
            const newRecipe = {
                recipeName: this.recipeName,
                recipeIngredientList: this.recipeIngredientList,
                recipeProcedure: this.recipeProcedureList,
                recipeCategory: this.recipeCategory,
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
    mounted() {
        this.initStoreDataSet();
        fetch("/images/no_image.png")
            .then((response) => response.blob())
            .then((blob) => new File([blob], "image.jpg"))
            .then((file) => {
                console.log(file);
                this.uploadFile(file);
                // fileはFileオブジェクト
            });
        // const file = new File(["blob"], "/images/no_image.png", {
        //     type: "image/jpeg",
        // });
        // 初期データの食材リストが未登録なら、トーストでメッセージを表示する
        this.ingredients.length == 0 ? (this.toastIsShow = true) : "";
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
            "setIngredients",
            "initIngredients",
        ]),

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

        editRecipeIngredient(ingredient, index) {
            this.setRecipeIngredientQuantity(
                ingredient.recipeIngredientQuantity
            );
            this.setRecipeIngredient(ingredient);
            // 食材編集モードをtrueに
            this.setIsEditingRecipeIngredient();
            this.setEditingRecipeIngredientIndex(index);
        },
        _deleteRecipeIngredient(index) {
            this.deleteRecipeIngredient(index);
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
        sendNewRecipe() {
            if (this.recipeName == "") {
                alert("レシピ名は必須です");
                return;
            }

            const url = "/api/users/" + this.userData.userId + "/recipes/add";
            let formData = new FormData();
            const file = document.getElementById("imagefile");
            formData.append("file", file.files[0]);
            formData.append("newRecipe", JSON.stringify(this.newRecipe));

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    console.log(res);
                    this.$router.push({ name: "recipes" });
                    this.initRecipeIngredientList();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addInitialIngredients() {
            axios
                .post(
                    "/api/users/" + this.userData.userId + "/ingredients/add",
                    {
                        initialIngredientList: JSON.stringify(
                            initialIngredientList
                        ),
                    }
                )
                .then((res) => {
                    console.log(res);
                    this.setIngredients(res.data);
                    this.toastIsShow = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadFile(e) {
            if (this.url == "/images/no_image.png") {
                console.log(e);
                this.file = e;
                this.url = URL.createObjectURL(this.file);
                return;
            }
            this.file = e.target.files[0];
            console.log(e.target.files[0]);
            this.url = URL.createObjectURL(this.file);
        },
        initStoreDataSet() {
            this.initRecipeName();
            this.initRecipeIngredient();
            this.initRecipeIngredientList();
            this.initIsEditingRecipeIngredient();
            this.initEditingRecipeIngredientIndex();
            this.initRecipeProcedure();
            this.initRecipeCategory();
            this.initRecipeProcedureList();
            this.initIsEditingRecipeProcedure();
            this.initEditingRecipeProcedureIndex();
            this.initRecipeIngredientQuantity();
        },
        initInputValue() {
            this.contents.inputContents.input.one.value = "";
            this.contents.inputContents.input.two.value = "";
        },
    },
};
</script>
