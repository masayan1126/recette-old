<template>
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content" :style="style.modalStyle">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ contents.modalContents.modalTitle }}
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
                    <ImagePreview
                        :upload-icon-style="style.unnecessaryElementStyle"
                        :title="'画像UL'"
                        :recipe-image-path="''"
                    />
                    <div class="w-100 mb-2">
                        <InputLabel
                            :id="contents.inputContents.label.one.id"
                            :name="contents.inputContents.label.one.name"
                        />
                        <TextInput
                            :id="contents.inputContents.input.one.id"
                            :type="contents.inputContents.input.one.type"
                            :value="contents.inputContents.input.one.value"
                            :className="'text-input-black'"
                            :style-name="style.inputContentsStyle"
                            @inputFormContent="
                                contents.inputContents.input.one.value = $event
                            "
                        />
                    </div>
                    <div class="w-100" :style="style.unnecessaryElementStyle">
                        <InputLabel
                            :id="contents.inputContents.label.two.id"
                            :name="contents.inputContents.label.two.name"
                        />
                        <TextInput
                            :id="contents.inputContents.input.two.id"
                            :type="contents.inputContents.input.two.type"
                            :value="contents.inputContents.input.two.value"
                            :className="'text-input-black'"
                            :style-name="style.inputContentsStyle"
                            @inputFormContent="
                                contents.inputContents.input.two.value = $event
                            "
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        キャンセル
                    </button>
                    <button
                        @click.prevent="updateUserData()"
                        type="button"
                        class="btn btn-primary"
                        data-dismiss="modal"
                    >
                        完了
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import TextInput from "./TextInput";
import InputLabel from "./InputLabel";
import ImagePreview from "./ImagePreview";
// import PrimaryButton from "../parts/PrimaryButton";

export default {
    name: "Modal",
    props: ["contents", "style", "propsFunction"],
    components: { TextInput, InputLabel, ImagePreview },
    data() {
        return {};
    },
    mounted() {
        this.propsFunction();
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
        }),
    },

    methods: {
        ...mapMutations(["setRecipes", "initRecipes", "setUserData"]),
    },
};
</script>
