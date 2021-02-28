<template>
    <div>
        <label :for="inputPartsInformationLabelId">{{
            inputPartsInformationLabel
        }}</label>
        <div class="d-flex">
            <div class="input-group">
                <input
                    type="text"
                    class="form-control"
                    :id="inputPartsInformationId"
                    :value="value"
                    @input="$emit('inputFormContent', $event.target.value)"
                />
                <div class="input-group-append">
                    <span class=""
                        ><i
                            @click="sendEditingTargetIngredientName"
                            class="fas fa-pencil-alt fa-2x"
                        ></i
                    ></span>
                    <span class=""
                        ><i
                            @click="deleteIngredient(index)"
                            class="fas fa-trash-alt fa-2x"
                        ></i
                    ></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TextInput",
    props: [
        "index",
        "value",
        "inputPartsInformationId",
        "inputPartsInformationLabel",
        "type",
        "inputPartsInformationLabelId",
        "deleteIngredient",
    ],
    data() {
        return {};
    },
    created() {},
    mounted() {
        console.log(this.inputPartsInformation);
    },
    methods: {
        sendEditingTargetIngredientName() {
            // console.log(value);
            this.$emit(
                "setEditingTargetIngredientName",
                this.value,
                this.index
            );
        },
    },
};
</script>
