<template>
    <section
        class="login h-75 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-reset">
            <div class="container-reset d-flex flex-column">
                <h4 class="text-center mb-5">パスワード再設定</h4>

                <div class="w-100">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-password'"
                        :name="'新しいパスワード'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-password'"
                        :type="'password'"
                        :value="resetForm.password"
                        @inputFormContent="resetForm.password = $event"
                    />
                </div>
                <div class="w-100">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-password-confirmation'"
                        :name="'確認用のパスワード'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-password-confirmation'"
                        :type="'password'"
                        :value="resetForm.password_confirmation"
                        @inputFormContent="
                            resetForm.password_confirmation = $event
                        "
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :button-name="'送信する'"
                        :button-style="authFormButtonStyle"
                        :props-function="resetPassword"
                    />
                </div>
                <div class="w-100 mt-4 text-center">
                    <router-link
                        class="small"
                        :to="{
                            name: 'login',
                        }"
                    >
                        ログイン画面へ
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Cookies from "js-cookie";
import InputLabel from "../parts/InputLabel";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import utilsMixin from "../../mixin/utility";
export default {
    components: {
        PrimaryButton,
        TextInput,
        InputLabel,
    },
    mixins: [utilsMixin],
    data() {
        return {
            resetForm: {
                password: "",
                password_confirmation: "",
                token: "",
            },
        };
    },
    created() {
        const token = Cookies.get("RESETTOKEN");
        // リセットトークンがない場合はログイン画面へ移動させる
        if (token == null) {
            this.$router.push("/login");
        }

        // フォームにリセットトークンをセット
        this.resetForm.token = token;

        // リセットトークンをクッキーから削除;
        if (token) {
            Cookies.remove("RESETTOKEN");
        }
    },
    methods: {
        resetPassword() {
            axios
                .post("/api/reset", this.resetForm)
                .then((res) => {
                    this.$router.push("/login");
                })
                .catch((error) => {});
        },
    },
};
</script>
