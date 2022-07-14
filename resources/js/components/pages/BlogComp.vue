<template>
    <div>
        <h1>Lista Post</h1>
        <PostComp v-for="post in posts" :key="post.id" :post="post" />

        <!-- Inserire  v-if="pagination.current != 1" OPPURE :disabled-->
        <button
            :disabled = "pagination.current === 1"
            @click="getApi(pagination.current - 1)">
            <<
        </button>

        <button
            v-for="i in pagination.last"
            :key="i"
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
    import PostComp from '../partials/PostComp.vue';

    export default {
        name: 'BlogComp',

        components:{
            PostComp
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
                .then(res =>{
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
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
