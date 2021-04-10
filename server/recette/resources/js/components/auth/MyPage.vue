<template>
    <section class="section-mypage h-100">
        <ReturnButton :props-function="routerBack" />
        <Modal
            :contents="contents"
            :style="style"
            :props-function="propsFunction"
        />
        <div
            class="wrapper-mypage mt-5 mt-sm-0 align-items-center d-flex justify-content-center"
        >
            <div class="container-mypage text-center">
                <p
                    class="text-right"
                    data-toggle="modal"
                    data-target="#exampleModal"
                >
                    <i class="far fa-edit mr-1"></i>編集する
                </p>
                <i class="fas fa-user-circle fa-6x"></i>
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
import { mapGetters, mapMutations } from "vuex";
import utilsMixin from "../../mixin/utility";
import ReturnButton from "../parts/ReturnButton";
import Modal from "../parts/Modal";
export default {
    components: {
        ReturnButton,
        Modal,
    },
    mixins: [utilsMixin],
    data() {
        return {
            // modalContents: {
            //     newUserData: {
            //         userId: null,
            //         userName: "",
            //         userEmailAdress: null,
            //         profileImagePath: null,
            //     },
            //     modalStyle: {
            //         backgroundColor: "#454545",
            //     },
            //     inputContents: {
            //         profileImage: "ユーザー画像",
            //         userName: "ユーザーネーム",
            //         email: "メールアドレス",
            //     },
            //     inputContentsStyle: {
            //         width: "100%",
            //     },
            // },
            contents: {
                modalContents: {
                    modalTitle: "ユーザー情報の編集",
                },
                inputContents: {
                    label: {
                        one: { id: "input-username", name: "ユーザーネーム" },
                        two: { id: "input-mail", name: "メールアドレス" },
                    },
                    input: {
                        one: {
                            id: "input-username",
                            value: "",
                            type: "text",
                        },
                        two: {
                            id: "input-mail",
                            value: "",
                            type: "email",
                        },
                    },
                },
            },
            style: {
                modalStyle: {
                    backgroundColor: "#454545",
                },
                unnecessaryElementStyle: {
                    // display: "none !important",
                },
                inputContentsStyle: {
                    width: "100%",
                },
            },
            propsFunction: {
                initInputValue: this.initInputValue,
            },
        };
    },
    mounted() {
        console.log(this.userData);
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            recipes: "getRecipes",
        }),
    },
    methods: {
        ...mapMutations(["setUserData"]),
        initInputValue() {
            this.contents.inputContents.input.one.value = "";
            this.contents.inputContents.input.two.value = "";
        },
        updateUserData() {
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
    },
};
</script>
