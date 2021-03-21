<template>
    <div class="area-image_preview">
        <div class="d-flex justify-content-end w-100">
            <label>
                <i class="fas fa-file-upload fa-2x mr-1"></i>
                <span>{{ title }}</span>
                <input
                    class="d-none"
                    name="imagefile"
                    id="imagefile"
                    type="file"
                    ref="preview"
                    @change="uploadFile"
                />
            </label>
        </div>
        <img :src="url" class="w-100" />
    </div>
</template>

<script>
export default {
    props: ["title", "recipeImagePath"],
    name: "ImagePreview",
    data() {
        return {
            url: this.recipeImagePath,
        };
    },
    mounted() {},
    computed: {},
    methods: {
        uploadFile() {
            const file = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
        },
        returnToPreviousPage: function () {
            history.back();
        },
    },
};
</script>
