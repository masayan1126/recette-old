const defaultDataset = {
    init: {
        answers: [
            { index: 1, content: "和食", nextId: "ja" },
            { index: 2, content: "洋食", nextId: "western" },
            { index: 3, content: "中華", nextId: "chinese" },
            { index: 4, content: "その他", nextId: "other" },
        ],
        question: "今日の気分は？",
    },
    ja: {
        answers: [
            { index: 1, content: "肉料理", nextId: "meat" },
            { index: 2, content: "魚料理", nextId: "fish" },
            { index: 3, content: "野菜料理", nextId: "veg" },
            { index: 4, content: "麺類", nextId: "noodle" },
            { index: 5, content: "ご飯もの", nextId: "rice" },
            { index: 6, content: "スープ、汁物", nextId: "soup" },
            { index: 7, content: "パン類", nextId: "bread" },
            { index: 8, content: "お菓子", nextId: "sweets" },
            { index: 9, content: "そのほか", nextId: "other" },
        ],
        question: "和食ですね。レシピのジャンルはどうされますか？",
    },
    western: {
        answers: [
            { index: 1, content: "肉料理", nextId: "meat" },
            { index: 2, content: "魚料理", nextId: "fish" },
            { index: 3, content: "野菜料理", nextId: "veg" },
            { index: 4, content: "麺類", nextId: "noodle" },
            { index: 5, content: "ご飯もの", nextId: "rice" },
            { index: 6, content: "スープ、汁物", nextId: "soup" },
            { index: 7, content: "パン類", nextId: "bread" },
            { index: 8, content: "お菓子", nextId: "sweets" },
            { index: 9, content: "そのほか", nextId: "other" },
        ],
        question: "洋食ですね。レシピのジャンルはどうされますか？",
    },
    chinese: {
        answers: [
            { index: 1, content: "肉料理", nextId: "meat" },
            { index: 2, content: "魚料理", nextId: "fish" },
            { index: 3, content: "野菜料理", nextId: "veg" },
            { index: 4, content: "麺類", nextId: "noodle" },
            { index: 5, content: "ご飯もの", nextId: "rice" },
            { index: 6, content: "スープ、汁物", nextId: "soup" },
            { index: 7, content: "パン類", nextId: "bread" },
            { index: 8, content: "お菓子", nextId: "sweets" },
            { index: 9, content: "そのほか", nextId: "other" },
        ],
        question: "中華ですね。レシピのジャンルはどうされますか？",
    },
    other: {
        answers: [
            { index: 1, content: "肉料理", nextId: "meat" },
            { index: 2, content: "魚料理", nextId: "fish" },
            { index: 3, content: "野菜料理", nextId: "veg" },
            { index: 4, content: "麺類", nextId: "noodle" },
            { index: 5, content: "ご飯もの", nextId: "rice" },
            { index: 6, content: "スープ、汁物", nextId: "soup" },
            { index: 7, content: "パン類", nextId: "bread" },
            { index: 8, content: "お菓子", nextId: "sweets" },
            { index: 9, content: "そのほか", nextId: "other" },
        ],
        question: "レシピのジャンルはどうされますか？",
    },
    //
    meat: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "肉料理ですね。調理時間について教えてください",
    },
    fish: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "魚料理ですね。調理時間について教えてください",
    },
    veg: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "野菜料理ですね。調理時間について教えてください",
    },
    noodle: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "麺料理ですね。調理時間について教えてください",
    },
    rice: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "ご飯ものですね。調理時間について教えてください",
    },
    soup: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "汁、スープものですね。調理時間について教えてください",
    },
    bread: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "パン類ですね。調理時間について教えてください",
    },
    sweets: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "スイーツですね。調理時間について教えてください",
    },
    other: {
        answers: [
            { index: 1, content: "あまり時間がない", nextId: "less" },
            { index: 2, content: "普通", nextId: "normal" },
            { index: 3, content: "かなり時間がある", nextId: "much" },
            { index: 4, content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "調理時間について教えてください",
    },
    //

    less: {
        answers: [
            { content: "ピックアップレシピを確認する", nextId: "result" },
            { content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "オススメのレシピをピックアップしました",
    },
    normal: {
        answers: [
            { content: "ピックアップレシピを確認する", nextId: "result" },
            { content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "オススメのレシピをピックアップしました",
    },
    much: {
        answers: [
            { content: "ピックアップレシピを確認する", nextId: "result" },
            { content: "最初の質問に戻る", nextId: "init" },
        ],
        question: "オススメのレシピをピックアップしました",
    },
};

export default defaultDataset;
