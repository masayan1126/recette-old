<template>
    <label :for="id">{{ name }}</label>
</template>

<script>
export default {
    name: "InputLabel",
    props: ["id", "name"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
