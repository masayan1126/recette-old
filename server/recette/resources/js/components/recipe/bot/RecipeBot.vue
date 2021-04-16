<template>
    <section class="section-recipe_bot mt-sm-5">
        <div class="wrapper-recipe_bot">
            <ReturnButton :props-function="routerBack" />
            <p v-if="results.length > 3" class="text-right">
                ジャンル：{{ results[0].answer }}、カテゴリー：{{
                    results[1].answer
                }}、調理時間：{{ results[2].answer }}
            </p>
            <div class="container-chat-recipe_bot">
                <div class="chat-box">
                    <Chats :chats="chats" />
                    <AnswersList :answers="answers" :select="selectAnswer" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import AnswersList from "./AnswersList";
import Chats from "./Chats";
import defaultDataset from "../../../assets/defaultDataset";
import { mapGetters, mapMutations } from "vuex";
import ReturnButton from "../../parts/ReturnButton";
import utilsMixin from "../../../mixin/utility";

export default {
    components: {
        AnswersList,
        Chats,
        ReturnButton,
    },
    mixins: [utilsMixin],
    name: "RecipeBot",
    data() {
        return {
            answers: [],
            chats: [],
            currentId: "init",
            dataset: {},
            defaultDataset: defaultDataset,
            results: [],
            loading: null,
        };
    },
    computed: {
        ...mapGetters({
            recipes: "getRecipes",
        }),
        botReccomendedRecipes() {
            const resultRecipeDataSet = {
                resultRecipeGenreIndex: this.results[0].index,
                resultRecipeCategory: this.results[1].answer,
                cookingTimeIndex: this.results[2].index,
            };

            const botReccomendedRecipes = this.recipes.filter(
                (recipe) =>
                    recipe.recipe_genre_index ==
                        resultRecipeDataSet.resultRecipeGenreIndex &&
                    recipe.recipe_category ==
                        resultRecipeDataSet.resultRecipeCategory &&
                    recipe.cooking_time_index ==
                        resultRecipeDataSet.cookingTimeIndex
            );
            return botReccomendedRecipes;
        },
    },
    created() {
        this.dataset = this.defaultDataset;

        // 最初の質問を表示
        this.displayNextQuestion(this.currentId, this.dataset[this.currentId]);
    },
    methods: {
        ...mapMutations(["setBotReccomendedRecipes"]),
        addChats(chat) {
            this.chats.push(chat);
        },
        addResults(result) {
            this.results.push(result);
            console.log(this.results);
        },
        displayNextQuestion(nextQuestionId, nextDataset) {
            // 選択された回答と次の質問をチャットに追加
            this.addChats({
                text: nextDataset.question,
                type: "question",
            });

            console.log(this.chats);

            // 次の回答一覧をセット
            this.answers = nextDataset.answers;

            // 現在の質問IDをセット
            this.currentId = nextQuestionId;
        },
        selectAnswer(selectedAnswer, nextQuestionId, index) {
            this.addResults({
                id: nextQuestionId,
                index: index,
                answer: selectedAnswer,
            });

            switch (true) {
                // 「結果を確認する」が選択された場合
                case nextQuestionId == "result":
                    console.log(this.botReccomendedRecipes);
                    this.setBotReccomendedRecipes(this.botReccomendedRecipes);
                    // setLoading(true);
                    setTimeout(() => {
                        this.$router.push({
                            name: "recipeList",
                            params: {
                                listType: "bot-recommend-recipes",
                            },
                        });
                        // dispatch(push("/recipes/list/bot/recommend"));
                    }, 3500);
                    break;
                default:
                    if (selectedAnswer == "最初の質問に戻る") {
                        this.results = [];
                    }
                    console.log(this.results);
                    // 現在のチャット一覧を取得
                    this.addChats({
                        text: selectedAnswer,
                        type: "answer",
                    });

                    setTimeout(
                        () =>
                            this.displayNextQuestion(
                                nextQuestionId,
                                this.dataset[nextQuestionId]
                            ),
                        2000
                    );
                    break;
            }
        },
    },
};
</script>
