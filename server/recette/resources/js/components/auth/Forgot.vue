<template>
    <section
        class="login h-75 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-login">
            <div class="container-login d-flex flex-column">
                <h4 class="text-center mb-5">パスワード再設定</h4>

                <div class="w-100">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-email'"
                        :name="'メールアドレス：'"
                    />
                    <TextInput
                        :id="'input-recipe-name'"
                        :type="'email'"
                        :value="form.email"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.email = $event"
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :buttonName="'送信する'"
                        :buttonStyle="loginButtonStyle"
                        :propsFunction="loginUser"
                    />
                </div>
                <div class="w-100 mt-4 text-center">
                    <router-link
                        class="small"
                        :to="{
                            name: 'register',
                        }"
                    >
                        会員登録がまだの方はこちら
                    </router-link>
                </div>
                <div class="w-100 mt-2 text-center">
                    <router-link
                        class="small"
                        :to="{
                            name: 'register',
                        }"
                    >
                        パスワードをお忘れの方はこちら
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
                email: "",
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
    mounted() {},
    methods: {
        ...mapMutations(["setUserData"]),
        loginUser() {
            console.log(this.form.email);
            axios
                .post("/api/forgot", { email: this.form.email })
                .then((res) => {
                    console.log(res.data);
                    this.$router.push("/login");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
