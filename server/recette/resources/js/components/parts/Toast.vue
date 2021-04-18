<template>
    <div
        class="fadein-bottom toast"
        :class="toastContents.toastIsShow ? 'show' : 'd-none'"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header">
            <strong class="mr-auto">{{ toastContents.toastTitle }}</strong>
            <button
                @click.prevent="toastContents.toastCloseFunction"
                type="button"
                class="ml-2 mb-1 close"
                data-dismiss="toast"
                aria-label="Close"
            >
                <span>&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <div>
                <p>初期設定の食材データを登録しますか？</p>
            </div>
            <div class="text-right">
                <button
                    class="btn btn-primary"
                    @click="toastContents.toastSubmitFunction"
                >
                    登録
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Toast",
    props: ["toastContents"],
};
</script>
