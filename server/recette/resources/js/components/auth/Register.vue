<template>
    <section
        class="register h-100 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-register d-md-flex">
            <div class="w-50 d-none d-md-block">
                <img
                    class="w-100 element-register_image-register"
                    src="/images/undraw_cooking_lyxy.svg"
                    alt=""
                />
            </div>
            <div class="w-100 w-md-50 container-login d-flex flex-column">
                <h4 class="mb-5">アカウント登録</h4>

                <div class="w-100">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-user-name'"
                        :name="'ユーザー名'"
                    />
                    <TextInput
                        :id="'input-user-name'"
                        :type="'text'"
                        :value="form.name"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.name = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-email'"
                        :name="'メールアドレス'"
                    />
                    <TextInput
                        :id="'input-email'"
                        :type="'email'"
                        :value="form.email"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.email = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-password'"
                        :name="'パスワード：'"
                    />
                    <TextInput
                        :id="'input-password'"
                        :type="'password'"
                        :value="form.password"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.password = $event"
                    />
                </div>
                <div class="w-100 mt-4">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-password_confirmation'"
                        :name="'確認用パスワード：'"
                    />
                    <TextInput
                        :id="'input-password_confirmation'"
                        :type="'password'"
                        :value="form.password_confirmation"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.password_confirmation = $event"
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :buttonName="'ログイン'"
                        :buttonStyle="loginButtonStyle"
                        :propsFunction="loginUser"
                    />
                </div>
                <div class="w-100 mt-4 text-center">
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
import { mapGetters, mapMutations } from "vuex";
import PrimaryButton from "../parts/PrimaryButton";
import TextInput from "../parts/TextInput";
import InputLabel from "../parts/InputLabel";
export default {
    components: {
        PrimaryButton,
        TextInput,
        InputLabel,
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errors: [],
            loginButtonStyle: {
                color: "#fff",
                backgroundColor: "#E4C8AD",
                fontSize: "12px",
                width: "100%",
                height: "35px",
            },
        };
    },
    methods: {
        saveForm() {
            axios
                .post("/api/register", this.form)
                .then((res) => {
                    console.log(res.data);
                    this.$router.push("/recipes");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
