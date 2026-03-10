<template>
    <div v-if="article != null">
        Добавлена новая статья <strong><a :href="`/articles/${article.id}`">{{ article.name }}</a></strong>
    </div>
</template>

<script>
export default {
    data() { return { article: null } },
    created() {
        window.Echo.channel('test').listen('NewArticleEvent', (data) => {
            this.article = data.article;
        })
    }
}
</script>