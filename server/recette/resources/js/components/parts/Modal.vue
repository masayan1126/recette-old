<template>
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <form
            action=""
            method="POST"
            enctype="multipart/form-data"
            id="create-recipe-form"
            name="createRecipeForm"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ modalTitle }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div
                            v-for="(ingredient, index) in ingredientList"
                            :key="ingredient.id"
                        >
                            <!-- <input type="hidden" name="_token" :value="csrf" />
                            <input
                                type="hidden"
                                name="revisedIngredientList[]"
                                :value="
                                    JSON.stringify(editingTargetIngredientList)
                                "
                            /> -->

                            <TextInput
                                :index="index"
                                @setEditingTargetIngredientName="set"
                                :value="ingredient.ingredient_name"
                                @inputFormContent="newIngredientName = $event"
                            />
                            <!-- <input
                            :value="editingTargetIngredient.ingredient_name"
                            type="text"
                            @click="
                                setEditingTargetIngredientName(
                                    editingTargetIngredient.ingredient_name
                                )setEditingTargetIngredientName
                            "
                        /> -->
                        </div>
                        <textarea
                            v-model="newIngredientName"
                            name=""
                            id=""
                            cols="30"
                            rows="10"
                        ></textarea>
                        <button
                            @click="updateTargetIngredientList()"
                            type="button"
                            class="btn btn-primary"
                        >
                            確定
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            @click="createEditedRecipe(ingredientList)"
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                        >
                            完了
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import TextInput from "./TextInput";
// import PrimaryButton from "../parts/PrimaryButton";

export default {
    name: "ImagePreview",
    props: ["modalTitle", "editingTargetIngredients", "createEditedRecipe"],
    components: { TextInput },
    data() {
        return {
            recipeName: "",
            recipeImage: "",
            newIngredientName: "",
            ingredientList: [],
            index: 0,
            // editingTargetIngredientList: [],
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {},
    methods: {
        returnToPreviousPage: function () {
            history.back();
        },

        update() {},
        // sendRevisedIngredientList() {
        //     const userId = this.$store.state.userId;
        //     document.createRecipeForm.action = `/users/${userId}/recipes/update`;
        //     document.createRecipeForm.submit();
        // },
    },
};
</script>
