<template>
    <section
        class="section-login h-100 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-login d-md-flex">
            <div class="w-50 d-none d-md-block">
                <img
                    class="w-100 element-login_image-login"
                    src="/images/undraw_cooking_lyxy.svg"
                    alt="ログイン画面の画像"
                />
            </div>
            <div class="container-login w-md-50 d-flex flex-column">
                <h4 class="text-center text-md-left mb-5">ログイン</h4>

                <div class="w-100">
                    <InputLabel
                        :class-name="'mb-0 w-100'"
                        :id="'input-email'"
                        :name="'メールアドレス：'"
                    />
                    <TextInput
                        :class-name="'text-input-black w-100'"
                        :id="'input-email'"
                        :type="'email'"
                        :value="loginForm.email"
                        @inputFormContent="loginForm.email = $event"
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
                        :value="loginForm.password"
                        @inputFormContent="loginForm.password = $event"
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :button-name="'ログインする'"
                        :button-style="authFormButtonStyle"
                        :props-function="login"
                    />
                </div>
                <div class="mt-3 mt-md-auto">
                    <div class="w-100 text-center text-md-left">
                        <router-link
                            class="small"
                            :to="{
                                name: 'register',
                            }"
                        >
                            会員登録がまだの方はこちら
                        </router-link>
                    </div>
                    <div class="w-100 text-center text-md-left">
                        <router-link
                            class="small"
                            :to="{
                                name: 'forgot',
                            }"
                        >
                            パスワードをお忘れの方はこちら
                        </router-link>
                    </div>
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
            loginForm: {
                email: "",
                password: "",
            },
        };
    },
    created() {
        this.initUserData();
    },
    methods: {
        ...mapActions(["setUserData", "initUserData"]),
        login() {
            axios
                .post("/api/login", this.loginForm)
                .then((res) => {
                    this.setUserData(res.data);
                    this.$router.push("/recipes");
                })
                .catch((error) => {});
        },
    },
};
</script>
