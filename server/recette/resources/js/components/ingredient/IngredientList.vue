<template>
    <section class="section-ingredient_list">
        <div class="wrapper-ingredient_list">
            <ReturnButton :props-function="routerBack" />
            <div class="mb-4 mt-4">
                <h5>食材一覧</h5>
                <div class="mt-4 d-md-flex justify-content-between">
                    <div class="w-md-65">
                        <Ingredient
                            :target-ingredients="vegIngredients"
                            :collapse-id="'veg-collapse'"
                            :props-function="propsFunction"
                        />
                        <Ingredient
                            :target-ingredients="meatIngredients"
                            :collapse-id="'meat-collapse'"
                            :props-function="propsFunction"
                        />
                        <Ingredient
                            :target-ingredients="cerealIngredients"
                            :collapse-id="'cereal-collapse'"
                            :props-function="propsFunction"
                        />
                        <Ingredient
                            :target-ingredients="
                                potatoes_starches_beans_mushrooms
                            "
                            :collapse-id="'potatoes_starches_beans_mushrooms-collapse'"
                            :props-function="propsFunction"
                        />
                    </div>
                    <div class="mt-4 mt-md-0 w-md-30">
                        <h5 class="mb-1">食材追加</h5>
                        <div class="container-ingredient_list">
                            <p class="mb-0">カテゴリー</p>
                            <div>
                                <div class="input-group mb-3">
                                    <select
                                        class="custom-select"
                                        v-model="ingredientCategory"
                                    >
                                        <option
                                            v-for="ingredientCategory in ingredientCategoryList"
                                            :value="ingredientCategory"
                                            :key="ingredientCategory"
                                        >
                                            {{ ingredientCategory }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <InputLabel
                                    :class-name="'mb-0'"
                                    :id="'input-ingredient-name'"
                                    :name="'食材名'"
                                />
                                <TextInput
                                    :class-name="'text-input-white w-100'"
                                    :id="'input-ingredient-name'"
                                    @inputFormContent="ingredientName = $event"
                                    :type="'text'"
                                    :value="ingredientName"
                                />
                                <PrimaryButton
                                    :button-name="'登録する'"
                                    :button-style="
                                        style.sendNewIngredientButtonStyle
                                    "
                                    :props-function="sendNewIngredient"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
import InputLabel from "../parts/InputLabel";
import PrimaryButton from "../parts/PrimaryButton";
import ReturnButton from "../parts/ReturnButton";
import Ingredient from "./Ingredient";
import TextInput from "../parts/TextInput";
import utilsMixin from "../../mixin/utility";

export default {
    components: {
        Ingredient,
        InputLabel,
        PrimaryButton,
        ReturnButton,
        TextInput,
    },
    mixins: [utilsMixin],
    name: "IngredientList",
    data() {
        return {
            ingredientCategoryList: [
                "野菜",
                "肉",
                "魚",
                "穀類",
                "芋・でん粉・豆・キノコ類",
            ],
            ingredientCategory: null,
            ingredientId: null,
            ingredientName: null,
            propsFunction: {
                editIngredientList: this.editIngredientList,
                deleteIngredientList: this.deleteIngredientList,
            },
            style: {
                sendNewIngredientButtonStyle: {
                    color: "#fff",
                    backgroundColor: "#E4C8AD",
                    width: "100%",
                    marginTop: "30px",
                },
            },
        };
    },
    computed: {
        ...mapGetters({
            ingredients: "getIngredients",
            userData: "getUserData",
        }),
        newIngredient() {
            const newIngredient = {
                ingredientCategory: this.ingredientCategory,
                ingredientName: this.ingredientName,
            };
            return newIngredient;
        },
        vegIngredients() {
            return this.ingredients.filter(
                (ingredient) => ingredient.ingredient_category == "野菜"
            );
        },
        meatIngredients() {
            return this.ingredients.filter(
                (ingredient) => ingredient.ingredient_category == "肉"
            );
        },
        fishIngredients() {
            return this.ingredients.filter(
                (ingredient) => ingredient.ingredient_category == "魚"
            );
        },
        cerealIngredients() {
            return this.ingredients.filter(
                (ingredient) => ingredient.ingredient_category == "穀類"
            );
        },
        potatoes_starches_beans_mushrooms() {
            return this.ingredients.filter(
                (ingredient) =>
                    ingredient.ingredient_category == "芋・でん粉・豆・キノコ類"
            );
        },
    },
    created() {},
    methods: {
        ...mapActions(["setIngredients"]),
        deleteIngredientList(ingredient) {
            const boolConfirmDeleteIngredient = confirm(
                "このレシピを削除してよろしいですか？"
            );
            if (boolConfirmDeleteIngredient == true) {
                const url =
                    "/api/users/" +
                    this.userData.userId +
                    "/ingredients/" +
                    ingredient.id +
                    "/delete";
                axios
                    .delete(url)
                    .then((res) => {
                        this.setIngredients(res.data);
                        this.$router.push({ name: "ingredientList" });
                    })
                    .catch((error) => {});
            }
        },
        editIngredientList(ingredient, index) {
            document.getElementById("input-ingredient-name").focus();
            this.ingredientId = ingredient.id;
            this.ingredientName = ingredient.ingredient_name;
            this.ingredientCategory = ingredient.ingredient_category;
        },
        sendNewIngredient: async function () {
            if (
                this.ingredientName == null ||
                this.ingredientCategory == null
            ) {
                alert("カテゴリーと食材名は必須です");
                return;
            }

            const url =
                "/api/users/" +
                this.userData.userId +
                "/ingredients/" +
                this.ingredientId +
                "/edit";

            let formData = new FormData();
            formData.append(
                "newIngredient",
                JSON.stringify(this.newIngredient)
            );

            await axios
                .post(url, formData, {
                    // headers: {
                    //     "Content-Type": "multipart/form-data",
                    // },
                })
                .then((res) => {
                    this.setIngredients(res.data);
                    this.ingredientName = null;
                    this.ingredientCategory = null;
                    this.ingredientId = null;
                    this.$router.push({ name: "ingredientList" });
                })
                .catch((error) => {});
        },
    },
};
</script>
