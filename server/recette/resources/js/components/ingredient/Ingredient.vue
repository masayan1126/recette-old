<template>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <button
                        class="btn w-100 text-left"
                        type="button"
                        data-toggle="collapse"
                        :data-target="`#${collapseId}`"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                    >
                        {{ targetIngredients[0].ingredient_category }}
                    </button>
                </h5>
            </div>

            <div :id="collapseId" class="collapse show">
                <div
                    class="card-body"
                    v-for="ingredient in targetIngredients"
                    :key="ingredient.id"
                >
                    <li class="font_size-resize d-flex justify-content-between">
                        <div>
                            {{ ingredient.ingredient_name }}
                        </div>

                        <div>
                            <span
                                ><i
                                    @click="
                                        propsFunction.editIngredientList(
                                            ingredient,
                                            index
                                        )
                                    "
                                    class="ml-2 fas fa-pencil-alt"
                                ></i
                            ></span>
                            <span
                                ><i
                                    @click="
                                        propsFunction.deleteIngredientList(
                                            ingredient
                                        )
                                    "
                                    class="ml-2 fas fa-trash-alt"
                                ></i
                            ></span>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
    },
    name: "Ingredient",
    props: ["targetIngredients", "collapseId", "propsFunction"],
    created() {
        console.log(this.targetIngredients);
    },
};
</script>
