<template>
    <div>
        <div class="text-right">
            <label>
                <div class="d-flex">
                    <p>レシピ画像をUL</p>
                    <!-- <i class="fas fa-image fa-2x"></i> -->
                    <i class="fas fa-file-upload fa-2x"></i>
                </div>
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
        <div v-if="url">
            <img :src="url" class="recipe_image_preview" />
        </div>
    </div>
</template>

<script>
export default {
    name: "ImagePreview",
    props: ["recipeImage"],
    data() {
        return {
            url: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {
        console.log(this.recipeImage);
        // console.log(this.$refs.preview);
        this.url = this.recipeImage;
    },
    methods: {
        uploadFile() {
            console.log(this.$refs.preview.files[0]);
            const file = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
        },
        returnToPreviousPage: function () {
            history.back();
        },
        goToRecipeEditScreen: function () {
            const userId = this.$store.state.userId;
            // urlから正規表現でrecipeidのみ抽出
            const recipeId = location.pathname.match(/([^\/.]+)/g)[3];
            console.log(recipeId);

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
    },
};
</script>
