<template>
    <section class="section-recipe_create">
        <ReturnButton :path-name="'recipes'" />
        <p class="text-right">
            <i
                data-toggle="modal"
                data-target="#exampleModal"
                class="far fa-edit"
            ></i>
        </p>
        <Modal :modal-title="'アカウント情報の編集'" />
        <div class="wrapper-recipe_create">
            <div class="recipe_container-top text-center">
                <i class="fas fa-user-circle fa-6x"></i>
                <p class="mb-0">{{ userData.userName }}</p>
                <p class="mb-0">
                    メールアドレス：{{ userData.userEmailAdress }}
                </p>
                <span>登録済みレシピの数：{{ recipes.length }}</span>
            </div>
        </div>
        <!-- <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h5>マイレシピ</h5>

            <router-link
                class="small"
                :to="{
                    name: 'myRecipes',
                    params: {
                        listType: 'マイレシピ',
                    },
                }"
            >
                すべて見る ＞
            </router-link>
        </div>
        <div class="items d-flex flex-wrap">
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
        </div>

        <div
            class="top-container-recipe-title d-flex justify-content-between mt-5"
        >
            <h5>お気に入りレシピ</h5>

            <router-link
                class="small"
                :to="{
                    name: 'myRecipes',
                    params: {
                        listType: 'マイレシピ',
                    },
                }"
            >
                すべて見る ＞
            </router-link>
        </div> -->
    </section>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
import ReturnButton from "../parts/ReturnButton";
import Modal from "../parts/Modal";
export default {
    components: {
        ReturnButton,
        Modal,
    },
    data() {
        return {};
    },
    mounted() {
        console.log(this.userData);
    },
    computed: {
        ...mapGetters({
            userData: "getUserData",
            userId: "getUserId",
            recipes: "getRecipes",
        }),
    },
    methods: {
        ...mapMutations(["setRecipes", "initRecipes", "setUserData"]),
    },
};
</script>
