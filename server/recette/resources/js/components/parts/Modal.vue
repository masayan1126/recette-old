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
                    <InputLabel
                        :id="'profile-image'"
                        :name="'プロフィール画像'"
                    />
                    <ImagePreview :title="'画像UL'" :recipe-image-path="''" />
                    <!-- <TextInput
                        :id="'profile-image'"
                        :type="'text'"
                        :value="profileImagePath"
                        @inputFormContent="profileImagePath = $event"
                    /> -->
                    <InputLabel :id="'user-name'" :name="'ユーザー名：'" />
                    <TextInput
                        :id="'user-name'"
                        :type="'text'"
                        :value="newUserData.userName"
                        @inputFormContent="newUserData.userName = $event"
                    />
                    <InputLabel :id="'email'" :name="'メールアドレス'" />
                    <TextInput
                        :id="'email'"
                        :type="'email'"
                        :value="newUserData.userEmailAdress"
                        :className="'text-input-black'"
                        @inputFormContent="newUserData.userEmailAdress = $event"
                    />
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
    props: ["modalTitle", "editingTargetIngredients", "createEditedRecipe"],
    components: { TextInput, InputLabel, ImagePreview },
    data() {
        return {
            newUserData: {
                userId: null,
                userName: "",
                userEmailAdress: null,
                profileImagePath: null,
            },
        };
    },
    mounted() {},
    computed: {
        ...mapGetters({
            userData: "getUserData",
            userId: "getUserId",
            recipes: "getRecipes",
        }),
    },

    methods: {
        ...mapMutations(["setRecipes", "initRecipes", "setUserData"]),
        updateUserData() {
            console.log(this.newUserData.userName);
            axios
                .put("/api/account/" + this.userData.userId + "/edit", {
                    newUserData: this.newUserData,
                    userName: this.newUserData.userName,
                })
                .then((response) => {
                    console.log(response);
                    this.setUserData(response.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
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
