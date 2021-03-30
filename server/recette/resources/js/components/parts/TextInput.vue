<template>
    <input
        :id="id"
        :class="className"
        :type="type"
        :value="value"
        @input="$emit('inputFormContent', $event.target.value)"
    />
</template>

<script>
export default {
    name: "TextInput",
    props: ["id", "type", "value", "className"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
