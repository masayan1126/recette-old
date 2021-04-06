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
                        params: params,
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
    props: ["breadCrumbList", "paramsType", "params"],
    data() {
        return {};
    },
    created() {},
    mounted() {},
    computed: {
        params() {
            const params = {};
            switch (this.paramsType) {
                case "recipeId":
                    params.recipeId = this.params;
                    return params;
                // break;

                case "listType":
                    params.listType = this.params;
                    return params;
                // break;
                // categoryPath
                default:
                    params.categoryPath = this.params;
                    return params;
                // break;
            }
        },
    },
    methods: {},
};
</script>
