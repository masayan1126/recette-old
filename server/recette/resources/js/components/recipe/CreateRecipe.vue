<template>
    <section class="recipe-detail-section">
        <p>レシピ新規登録画面</p>
        <i
            @click="returnToPreviousPage()"
            class="fas fa-long-arrow-alt-left fa-2x"
        ></i>

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
                :value="JSON.stringify(newRecipeObj)"
            />
            <div class="meal-container__recipe-deatail">
                <ImagePreview />
            </div>
            <div class="recipe-container__recipe-deatail">
                <div class="input-group mb-3">
                    <label class="d-block p-1">レシピ名：</label>
                </div>
                <div class="input-group mb-3">
                    <input
                        class="p-1 form-control"
                        type="text"
                        id="recipe-name"
                        name="recipe_name"
                        v-model="recipeName"
                    />
                </div>
            </div>

            <div class="ingredient-container__recipe-deatail">
                <p class="ingredient-title__recipe-detail">材料</p>
                <ul
                    v-for="(ingredient, index) in ingredientList"
                    :key="ingredient.id"
                >
                    <li>
                        {{ ingredient.ingredientName
                        }}<span class=""
                            ><i
                                @click="
                                    editIngredient(
                                        index,
                                        ingredient.ingredientName
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
                <p class="recipe-title__recipe-detail">作り方</p>
                <div class="recipe-description__recipe-deatail">
                    作り方が表示される
                </div>
            </div>
            <button
                @click="showRecipeDetail()"
                style="
                    width: 100%;
                    border-radius: 10%;
                    color: FFFFFF;
                    background-color: E4C8AD;
                "
            >
                登録する
            </button>
        </form>
    </section>
</template>

<script>
import Button from "../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button.vue";
import ImagePreview from "../parts/ImagePreview";

export default {
    name: "CreateRecipe",
    props: ["ingredients"],
    components: {
        ImagePreview,
    },
    data() {
        return {
            newRecipeObj: null,
            recipeName: "",
            ingredient: "",
            ingredientList: [],
            editing: false,
            editingIngredientIndex: 0,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {},
    methods: {
        showRecipeDetail: function () {
            const recipeId = 364;
            const userId = this.$store.state.userId;
            this.createNewRecipe();
            document.createRecipeForm.action = `/users/${userId}/recipes/store`;
            document.createRecipeForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
        createNewRecipe() {
            const newRecipeObj = {
                recipeName: this.recipeName,
                ingredients: this.ingredientList,
            };
            this.newRecipeObj = newRecipeObj;
        },
        addIngredient(ingredient) {
            if (this.editing == true) {
                const ingredientObj = {
                    // id: index + 1,
                    ingredientName: ingredient,
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
                ingredientName: ingredient,
            });
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
                "/users/" +
                this.$store.state.userId +
                "/recipes/" +
                "edit/" +
                recipeId;

            // location.pathname = `/users/${this.$store.state.userId} + "/" + recipeId`;
            // const recipeId = 364;
            // document.testForm.action = `/user/1/recipes/${recipeId}`;
            // document.testForm.submit();
            // let id = window.location.pathname.split("/recipe/edit")[1];
            // if (id) {
            //     id = id.split("/")[1];
            // }
        },
        editIngredient(index, ingredientName) {
            this.ingredient = ingredientName;
            this.editing = true;
            this.editingIngredientIndex = index;
        },
        deleteIngredient: function (index) {
            this.ingredientList.splice(index, 1);
            this.ingredient = "";
        },
    },
};
</script>
