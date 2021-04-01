<template>
    <div class="">
        <router-link :to="{ name: pathName, params: { recipeId: recipeId } }">
            <i class="fas fa-angle-left fa-2x"></i>
        </router-link>

        <hr />
    </div>
</template>

<script>
export default {
    name: "ReturnButton",
    props: ["pathName", "reicipeId"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
