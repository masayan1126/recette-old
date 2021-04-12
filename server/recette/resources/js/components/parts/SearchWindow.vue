<template>
    <div class="input-group" :class="className">
        <div class="input-group-prepend">
            <span class="input-group-text bg-gray" id="basic-addon1"
                ><i class="fas fa-search"></i
            ></span>
        </div>
        <input type="text" class="form-control bg-gray" />
    </div>
</template>

<script>
export default {
    name: "SearchWindow",
    props: ["className"],
};
</script>
