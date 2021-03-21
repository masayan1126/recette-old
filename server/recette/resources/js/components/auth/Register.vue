<template>
    <button type="submit" class="btn btn-primary">Register</button>
</template>

<script>
export default {
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {},
    methods: {},
};
</script>
