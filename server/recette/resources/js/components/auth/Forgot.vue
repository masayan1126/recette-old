<template>
    <section
        class="section-forgot h-100 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-forgot">
            <div class="container-forgot d-flex flex-column">
                <h4 class="text-center mb-5">パスワード再設定</h4>

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
                        :value="forgotForm.email"
                        @inputFormContent="forgotForm.email = $event"
                    />
                </div>

                <div class="w-100 mt-4 text-center">
                    <PrimaryButton
                        :button-name="'送信する'"
                        :button-style="authFormButtonStyle"
                        :props-function="sendPasswordResetMail"
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
        PrimaryButton,
        TextInput,
        InputLabel,
    },
    mixins: [utilsMixin],
    data() {
        return {
            forgotForm: {
                email: "",
            },
        };
    },
    methods: {
        ...mapActions(["setUserData"]),
        sendPasswordResetMail() {
            axios
                .post("/api/forgot", { email: this.forgotForm.email })
                .then((res) => {
                    this.$router.push("/login");
                })
                .catch((error) => {});
        },
    },
};
</script>
