<template>
    <div
        class="toast"
        :class="[{ show: isShow }, { hide: isHide }]"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header">
            <svg
                class="bd-placeholder-img rounded mr-2"
                width="20"
                height="20"
                xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice"
                focusable="false"
                role="img"
            >
                <rect fill="#007aff" width="100%" height="100%" />
            </svg>
            <strong class="mr-auto">食材登録</strong>
            <small class="text-muted">11 mins ago</small>
            <button
                type="button"
                class="ml-2 mb-1 close"
                data-dismiss="toast"
                aria-label="Close"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <button @click.prevent="propsFunction">登録する</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Toast",
    props: ["isShow", "isHide", "propsFunction"],
    components: {},
    data() {
        return {
            show: "show",
            hide: "none",
        };
    },
    computed: {},
    mounted() {},
    methods: {},
};
</script>
