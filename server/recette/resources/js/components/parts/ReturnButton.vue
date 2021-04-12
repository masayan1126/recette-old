<template>
    <div class="d-sm-none" @click="propsFunction">
        <i class="fas fa-angle-left fa-2x"></i>
        <hr />
    </div>
</template>

<script>
export default {
    name: "ReturnButton",
    props: ["propsFunction"],
};
</script>
