<template>
    <section class="section-mypage h-100">
        <ReturnButton :props-function="routerBack" />
        <Modal
            :modal-title="'アカウント情報の編集'"
            :modal-style="modalStyle"
            :input-contents="inputContents"
            :input-contents-style="inputContentsStyle"
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
            modalStyle: {
                backgroundColor: "#454545",
            },
            inputContents: {
                profileImage: "ユーザー画像",
                userName: "ユーザーネーム",
                email: "メールアドレス",
            },
            inputContentsStyle: {
                width: "100%",
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
    },
};
</script>
