<template>
    <section
        class="section-login h-75 d-flex align-items-center justify-content-center"
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
                        :name="'メールアドレス'"
                    />
                    <p class="small text-danger" v-if="errors.email">
                        ※{{ errors.email[0] }}
                    </p>

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
                        :name="'パスワード'"
                    />
                    <p class="small text-danger" v-if="errors.password">
                        ※{{ errors.password[0] }}
                    </p>

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
                    <div class="w-100 text-center text-md-left">
                        <p
                            @click="loginWithDemoUser()"
                            class="small cursor-pointer"
                        >
                            デモユーザーで試してみる
                        </p>
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
            errors: [],
        };
    },
    created() {
        this.initUserData();
    },
    methods: {
        ...mapActions(["setUserData", "initUserData"]),
        login: async function () {
            await axios
                .post("/api/login", this.loginForm)
                .then((res) => {
                    console.log("ログイン成功");
                    this.setUserData(res.data);
                    this.$router.push("/recipes");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error.response.data.errors);
                });
        },
        loginWithDemoUser: async function () {
            this.loginForm.email = "recipetarou@gmail.com";
            this.loginForm.password = "recipetarou4719";
            this.login();
        },
    },
};
</script>
