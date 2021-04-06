<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li
                v-for="breadCrumb in breadCrumbList"
                class="breadcrumb-item"
                :key="breadCrumb"
            >
                <router-link
                    :to="{
                        name: breadCrumb.linkName,
                    }"
                    >{{ breadCrumb.name }}
                </router-link>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    name: "BreadcrumbTrail",
    props: ["breadCrumbList"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    methods: {},
};
</script>
