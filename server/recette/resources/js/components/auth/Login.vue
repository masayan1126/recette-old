<template>
    <section
        class="login h-75 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-login">
            <div class="container-login d-flex flex-column">
                <h4 class="text-center mb-5">サインイン</h4>

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
                <div class="w-100 mt-4">
                    <InputLabel
                        class="mb-0 w-100"
                        :id="'input-password'"
                        :name="'パスワード：'"
                    />
                    <TextInput
                        :id="'input-recipe-name'"
                        :type="'password'"
                        :value="form.password"
                        :className="'text-input-black w-100'"
                        @inputFormContent="form.password = $event"
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
                            name: 'forgot',
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
                password: "",
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
    created() {
        this.initUserData();
        console.log(this.userData);
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
        }),
    },
    methods: {
        ...mapMutations(["setUserData", "initUserData"]),
        loginUser() {
            axios
                .post("/api/login", this.form)
                .then((res) => {
                    this.setUserData(res.data);
                    console.log(this.userData);
                    this.$router.push("/recipes");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
