<template>
    <label :class="className" :for="id">{{ name }}</label>
</template>

<script>
export default {
    name: "InputLabel",
    props: ["className", "id", "name"],
};
</script>
