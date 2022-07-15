<template>
    <div>
        <h1>Lista Post</h1>
        <PostItemComp v-for="post in posts" :key="`post${post.id}`" :post="post" />

        <!-- Inserire  v-if="pagination.current != 1" OPPURE :disabled-->
        <button
            :disabled = "pagination.current === 1"
            @click="getApi(pagination.current - 1)">
            &lt;&lt;
        </button>

        <button
            v-for="i in pagination.last"
            :key="`btn${i}`"
            @click="getApi(i)"
            :disabled = "pagination.current === i" >
            {{i}}
        </button>

        <!-- Inserire v-if="pagination.current != pagination.last" OPPURE :disabled-->
        <button
            :disabled = "pagination.current === pagination.last"
            @click="getApi(pagination.current + 1)">
            >>
        </button>
    </div>
</template>

<script>
    import PostItemComp from '../partials/PostItemComp.vue';

    export default {
        name: 'BlogComp',

        components:{
            PostItemComp
        },

        data(){
            return{
                apiUrl: '/api/posts',
                posts: [],
                pagination: {
                    current: null,
                    last: null
                }
            }
        },

        methods: {
            getApi(page){
                axios.get(this.apiUrl + '?page=' + page)
                .then(response =>{
                    const rd = response.data;

                    this.posts = rd.posts.data;
                    this.pagination = {
                        current: rd.posts.current_page,
                        last: rd.posts.last_page,
                    }
                })
            }
        },

        mounted(){
            this.getApi(1);
        }
    }
</script>

<style lang="scss" scoped>

</style>
