<template>
    <div @click="propsFunction" class="d-sm-none">
        <i class="fas fa-angle-left fa-2x"></i>
        <hr />
    </div>
</template>

<script>
export default {
    name: "ReturnButton",
    props: ["propsFunction"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
