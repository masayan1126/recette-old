<template>
    <ul id="scroll-area" class="mb-5">
        <Chat
            v-for="chat in chats"
            :key="chat"
            :text="chat.text"
            :type="chat.type"
        />
    </ul>
</template>

<script>
import Chat from "./Chat";
import { mapGetters } from "vuex";
import ReturnButton from "../../parts/ReturnButton";
import utilsMixin from "../../../mixin/utility";

export default {
    components: {
        Chat,
        ReturnButton,
    },
    props: ["chats"],
    mixins: [utilsMixin],
    name: "Chats",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
    },
    mounted() {},
    methods: {},
};
</script>
