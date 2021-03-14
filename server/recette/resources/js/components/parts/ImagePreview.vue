<template>
    <div>
        <div class="text-right">
            <label>
                <div class="d-flex">
                    <i class="fas fa-file-upload fa-2x mr-1"></i>
                    <p>レシピ画像UL</p>
                    <!-- <i class="fas fa-image fa-2x"></i> -->
                </div>
                <input
                    class="d-none"
                    name="imagefile"
                    id="imagefile"
                    type="file"
                    ref="preview"
                    @change="uploadFile"
                />
                <input
                    class="d-none"
                    name="noImage"
                    id="no-imagefile"
                    type="file"
                    ref="noimage"
                />
            </label>
        </div>
        <div v-if="url">
            <img :src="url" class="recipe_image_preview" />
        </div>
        <div v-else>
            <img
                name="noImage"
                src="./no_image.png"
                class="recipe_image_preview"
            />
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
        this.url = this.recipeImage;
    },
    methods: {
        uploadFile() {
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
