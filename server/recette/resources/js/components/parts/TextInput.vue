<template>
    <input
        :class="className"
        :id="id"
        :placeholder="placeholder"
        :style="styleName"
        :type="type"
        :value="value"
        @input="$emit('inputFormContent', $event.target.value)"
    />
</template>

<script>
export default {
    name: "TextInput",
    props: ["className", "id", "placeholder", "styleName", "type", "value"],
};
</script>
