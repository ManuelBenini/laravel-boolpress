<template>
    <div class="d-flex">

        <LoadingComp v-if="isLoading" />

        <div class="post-container" v-else>
            <h1>Lista Post</h1>
            <PostItemComp v-for="post in posts" :key="`post${post.id}`" :post="post" />

            <div class="btn-container" v-if="showPagination">

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

        </div>

        <SidebarComp :categories="categories" :tags="tags" @postsByCategory="postsByCategory" @postsByTag="postsByTag" @getAllPosts="getApi(1)"/>

    </div>
</template>

<script>
    import PostItemComp from '../partials/PostItemComp.vue';
    import SidebarComp from '../partials/SidebarComp.vue';
    import LoadingComp from '../partials/LoadingComp.vue';

    export default {
        name: 'BlogComp',

        components:{
            PostItemComp,
            SidebarComp,
            LoadingComp
        },

        data(){
            return{
                apiUrl: '/api/posts',
                posts: [],
                pagination: {
                    current: null,
                    last: null
                },
                categories: [],
                tags: [],
                showPagination: true,
                isLoading: true
            }
        },

        methods: {
            getApi(page){
                axios.get(this.apiUrl + '?page=' + page)
                .then(response =>{
                    this.showPagination = true;
                    const rd = response.data;

                    this.posts = rd.posts.data;
                    this.pagination = {
                        current: rd.posts.current_page,
                        last: rd.posts.last_page,
                    };
                    this.categories = rd.categories;
                    this.tags = rd.tags;

                    if(rd.posts.data.length === this.posts.length){
                        this.isLoading = false
                    }
                })
            },

            getFilteredPost(filter_uri, filter_slug){
                this.showPagination = false;

                axios.get(this.apiUrl + filter_uri + filter_slug)
                .then(response =>{
                    const rd = response.data;
                    this.posts = rd.posts;

                    if(rd.posts.data.length === this.posts.length){
                        this.isLoading = false
                    }
                })
            },

            postsByCategory(category_slug){
                this.getFilteredPost('/post-per-categoria/', category_slug);
            },

            postsByTag(tag_slug){
                this.getFilteredPost('/post-per-tag/', tag_slug);
            }
        },

        mounted(){
            this.getApi(1);
        }
    }
</script>

<style lang="scss" scoped>

</style>
