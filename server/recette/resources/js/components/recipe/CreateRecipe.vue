<template>
    <section class="section-recipe_create">
        <div class="wrapper-recipe_create">
            <ReturnButton :path-name="'recipes'" />
            <Toast
                :is-show="isShow"
                :is-hide="isHide"
                :props-function="addInitialIngredients"
            />

            <div class="area-image_preview d-flex justify-content-between">
                <img :src="url" class="w-75" />
                <div class="d-flex justify-content-end w-25">
                    <label>
                        <i class="fas fa-file-upload mr-1"></i>
                        <span class="small">{{ "test" }}</span>
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

            <div class="container-recipe mb-4 d-flex mt-2 align-items-end">
                <InputLabel
                    class="mb-0"
                    :id="'input-recipe-name'"
                    :name="'レシピ名：'"
                />
                <TextInput
                    :id="'input-recipe-name'"
                    :type="'text'"
                    :value="recipeName"
                    :className="'text-input'"
                    @inputFormContent="recipeName = $event"
                />
            </div>
            <div class="container-recipe_ingredient mb-4">
                <p class="mb-0">材料</p>
                <div class="area-ingredient">
                    <ul
                        class="pl-1"
                        v-for="(ingredient, index) in recipeIngredientList"
                        :key="ingredient.id"
                    >
                        <li>
                            {{ ingredient.ingredient_name }}
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
                                {{ ingredient.ingredient_name }}
                            </option>
                        </select>
                        <i
                            @click.prevent="addRecipeIngredient"
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

            <div class="container-recipe_ingredient mb-4">
                <p class="mb-0">カテゴリー</p>
                <div class="area-ingredient">
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

            <!-- <input type="hidden" name="_token" :value="csrf" />
            <input
                type="hidden"
                name="newRecipe"
                :value="JSON.stringify(newRecipe)"
            /> -->
            <PrimaryButton
                :buttonName="'登録する'"
                :props-function="sendNewRecipe"
                :buttonStyle="sendNewRecipeButtonStyle"
            />
        </div>
    </section>
</template>

<script>
import ImagePreview from "../parts/ImagePreview";
import PrimaryButton from "../parts/PrimaryButton";
import ReturnButton from "../parts/ReturnButton";
import TextInput from "../parts/TextInput";
import InputLabel from "../parts/InputLabel";
import Toast from "../parts/Toast";
import initialIngredientList from "../../assets/initialIngredientList.json";
import { mapGetters, mapMutations } from "vuex";

export default {
    name: "CreateRecipe",
    props: [],
    components: {
        ImagePreview,
        PrimaryButton,
        Toast,
        TextInput,
        InputLabel,
        ReturnButton,
    },
    data() {
        return {
            // 初期データの食材リスト登録状況に応じてトーストの表示を切り替えるためのフラグ
            isShow: false,
            isHide: false,
            sendNewRecipeButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
            file: null,
            url: null,
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
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        ...mapGetters({
            userId: "getUserId",
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
    },
    mounted() {
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

        // 初期データの食材リストが未登録なら、トーストでメッセージを表示する
        this.ingredients.length == 0
            ? (this.isShow = true)
            : (this.isHide = true);
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

        addRecipeIngredient() {
            if (this.recipeIngredient == null) {
                alert("食材を選択してください");
                return;
            }
            // 追加 or 編集の分岐はmutatiion側で判定
            this.setRecipeIngredientList(this.recipeIngredient);
            this.initRecipeIngredient();
        },

        editRecipeIngredient(ingredient, index) {
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
            this.initRecipeIngredientList();

            const url = "/api/users/" + this.userId + "/recipes/add";
            let formData = new FormData();
            const file = document.getElementById("imagefile");
            formData.append("file", file.files[0]);
            formData.append("newRecipe", JSON.stringify(this.newRecipe));
            console.log(formData);

            axios
                .post(
                    url,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                    // newRecipe: JSON.stringify(this.newRecipe),
                )
                .then((res) => {
                    console.log(res);
                    // this.$router.push({ name: "recipes" });
                })
                .catch((error) => {
                    console.log(error);
                });
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
        uploadFile(e) {
            this.file = e.target.files[0];
            this.url = URL.createObjectURL(this.file);
            console.log(this.file);
        },
    },
};
</script>
