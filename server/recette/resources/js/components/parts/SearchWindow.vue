<template>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text bg-gray" id="basic-addon1"
                ><i class="fas fa-search"></i
            ></span>
        </div>
        <input type="text" class="form-control bg-gray" />
    </div>
    <!-- <div style="width: 400px">
        <vue-suggest-input v-model="selected" :items="items" />
    </div> -->
</template>

<script>
import VueSuggestInput from "vue-suggest-input";
import "vue-suggest-input/dist/vue-suggest-input.css";
export default {
    name: "SearchWindow",
    props: ["id", "name"],
    components: {
        VueSuggestInput,
    },
    data() {
        return {
            items: ["apple", "cocoa", "coffee", "cola"],
            selected: "",
        };
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
