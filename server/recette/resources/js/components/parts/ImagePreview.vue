<template>
    <div :style="uploadIconStyle" class="d-flex justify-content-between">
        <img :src="url" class="w-75" />
        <div class="d-flex justify-content-end w-25">
            <label>
                <i class="fas fa-file-upload mr-1"></i>
                <span class="small">{{ title }}</span>
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
    </div>
</template>

<script>
export default {
    props: ["title", "setImagefile", "uploadIconStyle"],
    name: "ImagePreview",
    data() {
        return {
            url: null,
        };
    },
    mounted() {},
    computed: {},
    methods: {
        uploadFile() {
            const file = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
            console.log(this.url);
            this.setImagefile(URL.createObjectURL(file));
        },
        returnToPreviousPage: function () {
            history.back();
        },
    },
};
</script>
