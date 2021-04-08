<template>
    <section
        class="register h-100 d-flex align-items-center justify-content-center"
    >
        <div class="wrapper-register h-50 text-center text-md-left d-md-flex">
            <div class="w-50 mx-auto d-md-block">
                <img
                    class="w-100 element-register_image-register"
                    src="/images/undraw_page_not_found_su7k.svg"
                    alt=""
                />
            </div>
            <div class="w-100 w-md-50 container-login d-flex flex-column">
                <h5 class="mt-3 mt-md-0">
                    お探しのページは見つかりませんでした。
                </h5>
                <p>5秒後にトップページへリダイレクトします。</p>
                <div class="w-100 mt-2">
                    <router-link
                        :to="{
                            name: 'recipes',
                        }"
                    >
                        トップページに戻る
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";

export default {
    components: {},
    name: "NotFound",
    props: [],
    data() {
        return {};
    },
    created() {},
    mounted() {
        console.log();
        setTimeout(() => {
            this.$router.push({ name: "recipes" });
        }, 5000);
    },
    computed: {},
    methods: {},
};
</script>
