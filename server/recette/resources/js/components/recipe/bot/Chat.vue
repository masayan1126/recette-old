<template>
    <li
        class="mb-4"
        :class="[isQuestion ? 'element-chat_row' : 'element-chat_reverse']"
    >
        <i v-if="type == 'question'" class="fas fa-robot fa-2x mr-2"></i>
        <img
            v-else
            class="ml-2"
            :src="userData.profileImagePath"
            alt="チャットのユーザーアイコン"
        />
        <div class="element-chat_bubble">{{ text }}</div>
    </li>
</template>

<script>
import { mapGetters } from "vuex";
import ReturnButton from "../../parts/ReturnButton";
import utilsMixin from "../../../mixin/utility";

export default {
    components: {
        ReturnButton,
    },
    props: ["text", "type"],
    mixins: [utilsMixin],
    name: "Chat",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
            userData: "getUserData",
        }),
        isQuestion() {
            if (this.type == "question") {
                return true;
            }

            return false;
        },
    },
    created() {
        console.log(this.isQuestion);
    },
    methods: {},
};
</script>
