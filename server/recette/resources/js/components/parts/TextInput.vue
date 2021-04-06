<template>
    <input
        :id="id"
        :class="className"
        :type="type"
        :value="value"
        :placeholder="placeholder"
        @input="$emit('inputFormContent', $event.target.value)"
    />
</template>

<script>
export default {
    name: "TextInput",
    props: ["id", "type", "value", "className", "placeholder"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
