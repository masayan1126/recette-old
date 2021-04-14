<template>
    <div class="d-flex justify-content-between mb-1">
        <img :src="url" class="w-50 w-lg-70" />
        <div class="d-flex justify-content-end w-30">
            <label>
                <i class="fas fa-file-upload mr-1"></i>
                <span class="small">{{
                    imagePreviewContents.uploadLinkTitle
                }}</span>
                <input
                    class="d-none"
                    :id="imagePreviewContents.fileId"
                    :name="imagePreviewContents.fileName"
                    ref="preview"
                    type="file"
                    @change="uploadFile($event)"
                />
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: ["imagePreviewContents"],
    name: "ImagePreview",
    data() {
        return {
            file: null,
            url: "/images/no_image.png",
        };
    },
    created() {
        if (this.imagePreviewContents.defaultImage != null) {
            this.url = this.imagePreviewContents.defaultImage;
            return;
        }

        this.uploadDefaultImage();
    },
    methods: {
        uploadFile(e) {
            if (this.url == "/images/no_image.png") {
                this.file = e;
                this.url = URL.createObjectURL(this.file);
                return;
            }
            this.file = e.target.files[0];
            this.url = URL.createObjectURL(this.file);
        },
        uploadDefaultImage() {
            fetch("/images/no_image.png")
                .then((response) => response.blob())
                .then((blob) => new File([blob], "no_image.png"))
                .then((file) => {
                    this.uploadFile(file);
                });
        },
    },
};
</script>
