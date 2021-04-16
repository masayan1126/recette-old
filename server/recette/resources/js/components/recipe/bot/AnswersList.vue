<template>
    <div class="element-chat_answer">
        <Answer
            v-for="(answer, index) in answers"
            :key="index.toString()"
            :answer="answer"
            :select="select"
        />
    </div>
</template>

<script>
import Answer from "./Answer";
import { mapGetters } from "vuex";
import ReturnButton from "../../parts/ReturnButton";
import utilsMixin from "../../../mixin/utility";

export default {
    components: {
        Answer,
        ReturnButton,
    },
    props: ["answers", "select"],
    mixins: [utilsMixin],
    name: "AnswerList",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
    },
    created() {},
    methods: {},
};
</script>
