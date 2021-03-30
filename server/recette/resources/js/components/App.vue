<template>
    <div>
        <main class="py-4">
            <p>testu</p>
            <div class="container">
                <RouterView />
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: "App",
    props: [],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    created() {},
    mounted() {},
    computed: {},
    methods: {},
};
</script>
