<template>
    <section
        class="section-register h-100 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-register d-md-flex">
            <div class="w-50 d-none d-md-block">
                <img
                    class="w-100 element-register_image-register"
                    src="/images/undraw_cooking_lyxy.svg"
                    alt="会員登録画面の画像"
                />
            </div>
            <div class="w-100 w-md-50 container-register d-flex flex-column">
                <h4 class="mb-5 text-center text-md-left">アカウント登録</h4>

                <div class="w-100">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-username'"
                        :name="'ユーザー名'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-username'"
                        :type="'text'"
                        :value="registerForm.name"
                        @inputFormContent="registerForm.name = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-email'"
                        :name="'メールアドレス'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-email'"
                        :type="'email'"
                        :value="registerForm.email"
                        @inputFormContent="registerForm.email = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-password'"
                        :name="'パスワード：'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-password'"
                        :type="'password'"
                        :value="registerForm.password"
                        @inputFormContent="registerForm.password = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-password-confirmation'"
                        :name="'確認用パスワード：'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-password-confirmation'"
                        :type="'password'"
                        :value="registerForm.password_confirmation"
                        @inputFormContent="
                            registerForm.password_confirmation = $event
                        "
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :button-name="'登録する'"
                        :button-style="authFormButtonStyle"
                        :props-function="register"
                    />
                </div>
                <div class="w-100 mt-2 mt-md-auto text-center text-md-left">
                    <router-link
                        class="small"
                        :to="{
                            name: 'login',
                        }"
                    >
                        すでにアカウントをお持ちの方はこちら
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import InputLabel from "../parts/InputLabel";
import { mapActions } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import utilsMixin from "../../mixin/utility";
export default {
    components: {
        InputLabel,
        PrimaryButton,
        TextInput,
    },
    mixins: [utilsMixin],
    data() {
        return {
            registerForm: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
        };
    },
    methods: {
        ...mapActions(["setUserData"]),
        register() {
            axios
                .post("/api/register", this.registerForm)
                .then((res) => {
                    this.setUserData(res.data);
                    this.$router.push("/recipes");
                })
                .catch((error) => {});
        },
    },
};
</script>
