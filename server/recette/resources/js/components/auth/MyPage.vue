<template>
    <section class="section-mypage h-100">
        <ReturnButton :props-function="routerBack" />
        <Modal
            :input-contents="contents.inputContents"
            :input-style="style.inputContentsStyle"
            :image-preview-contents="
                contents.imagePreviewContentsForProfileImage
            "
            :modal-contents="contents.modalContents"
            :modal-style="style.modalStyle"
            :modal-set-function="contents.modalContents.modalSetFunction"
            :modal-submit-function="contents.modalContents.modalSubmitFunction"
            :unnecessary-element-style="style.unnecessaryElementStyle"
        />
        <p
            class="text-right"
            data-toggle="modal"
            :data-target="`#${contents.modalContents.modalId}`"
        >
            <i class="far fa-edit mr-1"></i>編集する
        </p>
        <div
            class="wrapper-mypage mt-5 mt-sm-0 align-items-center d-flex justify-content-center"
        >
            <div class="container-mypage text-center">
                <img
                    alt="プロフィール画像"
                    class="w-50"
                    :src="userData.profileImagePath"
                />
                <p class="mb-0">ユーザー名：{{ userData.userName }}</p>
                <p class="mb-0">
                    メールアドレス：{{ userData.userEmailAdress }}
                </p>
                <span>登録済みレシピ：{{ recipes.length }}</span>
            </div>
        </div>
    </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "../parts/Modal";
import ReturnButton from "../parts/ReturnButton";
import utilsMixin from "../../mixin/utility";
export default {
    components: {
        Modal,
        ReturnButton,
    },
    mixins: [utilsMixin],
    data() {
        return {
            contents: {
                modalContents: {
                    modalId: "edit-profile-modal",
                    modalTitle: "ユーザー情報の編集",
                    modalSetFunction: null,
                    modalSubmitFunction: this.updateProfileData,
                },
                inputContents: {
                    label: {
                        one: { id: "input-username", name: "ユーザーネーム" },
                        two: { id: "input-email", name: "メールアドレス" },
                    },
                    input: {
                        one: {
                            id: "input-username",
                            value: "",
                            type: "text",
                        },
                        two: {
                            id: "input-email",
                            value: "",
                            type: "email",
                        },
                    },
                },
                imagePreviewContentsForProfileImage: {
                    defaultImage: null,
                    fileId: "profile-image-file",
                    fileName: "profile-image-file",
                    uploadLinkTitle: "プロフィール画像選択",
                },
            },
            style: {
                modalStyle: {
                    backgroundColor: "#454545",
                },
                unnecessaryElementStyle: null,
                inputContentsStyle: {
                    width: "100%",
                },
            },
        };
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
            userData: "getUserData",
        }),
    },
    created() {
        this.setProfileData();
    },
    methods: {
        ...mapActions(["setUserData"]),
        setProfileData() {
            this.contents.inputContents.input.one.value = this.userData.userName;
            this.contents.inputContents.input.two.value = this.userData.userEmailAdress;
            this.contents.imagePreviewContentsForProfileImage.defaultImage = this.userData.profileImagePath;
        },
        updateProfileData() {
            let formData = new FormData();
            const file = document.getElementById("profile-image-file");
            const url = "/api/account/" + this.userData.userId + "/edit";
            formData.append("profile-image-file", file.files[0]);
            const newUserData = {
                userName: this.contents.inputContents.input.one.value,
                email: this.contents.inputContents.input.two.value,
            };
            formData.append("newUserData", JSON.stringify(newUserData));

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-HTTP-Method-Override": "PUT",
                    },
                })
                .then((res) => {
                    this.setUserData(res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
