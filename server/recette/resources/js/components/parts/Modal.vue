<template>
    <div
        aria-hidden="true"
        aria-labelledby="exampleModalLabel"
        class="modal fade"
        :id="modalContents.modalId"
        role="dialog"
        tabindex="-1"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content" :style="modalStyle">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ modalContents.modalTitle }}
                    </h5>
                    <button
                        aria-label="Close"
                        class="close"
                        data-dismiss="modal"
                        type="button"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div :style="unnecessaryElementStyle">
                        <ImagePreview
                            :image-preview-contents="imagePreviewContents"
                        />
                    </div>

                    <div class="w-100 mb-2">
                        <InputLabel
                            :id="inputContents.label.one.id"
                            :name="inputContents.label.one.name"
                        />
                        <TextInput
                            :class-name="'text-input-black'"
                            :id="inputContents.input.one.id"
                            @inputFormContent="
                                inputContents.input.one.value = $event
                            "
                            :style-name="inputStyle"
                            :type="inputContents.input.one.type"
                            :value="inputContents.input.one.value"
                        />
                    </div>
                    <div class="w-100" :style="unnecessaryElementStyle">
                        <InputLabel
                            :id="inputContents.label.two.id"
                            :name="inputContents.label.two.name"
                        />
                        <TextInput
                            :class-name="'text-input-black'"
                            :id="inputContents.input.two.id"
                            @inputFormContent="
                                inputContents.input.two.value = $event
                            "
                            :style-name="inputStyle"
                            :type="inputContents.input.two.type"
                            :value="inputContents.input.two.value"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        type="button"
                    >
                        キャンセル
                    </button>
                    <button
                        class="btn btn-primary"
                        @click.prevent="modalSubmitFunction()"
                        data-dismiss="modal"
                        type="button"
                    >
                        完了
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ImagePreview from "./ImagePreview";
import InputLabel from "./InputLabel";
import TextInput from "./TextInput";

export default {
    components: { TextInput, InputLabel, ImagePreview },
    name: "Modal",
    props: [
        "imagePreviewContents",
        "inputContents",
        "inputStyle",
        "modalContents",
        "modalStyle",
        "modalSetFunction",
        "modalSubmitFunction",
        "unnecessaryElementStyle",
    ],
    created() {
        if (this.modalSetFunction != null) {
            this.modalSetFunction();
        }
    },
};
</script>
