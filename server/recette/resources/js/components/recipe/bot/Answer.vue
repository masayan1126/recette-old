<template>
    <button
        class="btn"
        @click="select(answer.content, answer.nextId, answer.index)"
    >
        {{ answer.content }}
    </button>
</template>

<script>
import { mapGetters } from "vuex";
import ReturnButton from "../../parts/ReturnButton";
import utilsMixin from "../../../mixin/utility";

export default {
    components: {
        ReturnButton,
    },
    props: ["answer", "select"],
    mixins: [utilsMixin],
    name: "Answer",
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
