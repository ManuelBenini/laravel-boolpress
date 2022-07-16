<template>
    <div class="d-flex">

        <LoadingComp v-if="isLoading" />

        <div class="post-container" v-else>
            <h1>Lista Post</h1>

            <div class="posts" v-if="posts.length > 0">
                <PostItemComp v-for="post in posts" :key="`post${post.id}`" :post="post" />
            </div>

            <h3 v-else>La ricerca non ha restituito nessun post</h3>

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

        <SidebarComp
            :categories="categories" :tags="tags"
            @postsByCategory="postsByCategory"
            @postsByTag="postsByTag"
            @getAllPosts="getApi(1)"
            @disableCatFilter="disableCatFilter"
            @disableTagFilter="disableTagFilter"
        />

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
                isLoading: true,
                postFilterdByCat: false,
                postFilterdByTag: false,
                category_slug: '',
                tag_slug: ''

            }
        },

        methods: {
            getApi(page){
                axios.get(this.apiUrl + '?page=' + page)
                .then(response =>{
                    this.showPagination = true;
                    this.postFilterdByCat = false;
                    this.postFilterdByTag = false;
                    const rd = response.data;

                    this.posts = rd.posts.data;
                    this.pagination = {
                        current: rd.posts.current_page,
                        last: rd.posts.last_page,
                    };
                    this.categories = rd.categories;
                    this.tags = rd.tags;

                    if(this.posts.length === rd.posts.data.length){
                        this.isLoading = false
                    }
                })
            },

            getFilteredPost(filter_uri, filter_slug){
                this.showPagination = false;

                axios.get(this.apiUrl + filter_uri + filter_slug)
                .then(response =>{
                    const rd = response.data.posts;

                    this.posts = rd;
                    console.log(this.posts);

                    if(this.posts.length === rd.length){
                        this.isLoading = false
                    }
                })
            },

            getfilteredPostCatTag(category_slug, tag_slug){
                axios.get(this.apiUrl + '/post-cat-tag/' + category_slug + '/' + tag_slug)
                .then(response =>{
                    const rd = response.data;

                    this.posts = rd;
                    console.log('array filtrato con cat e tag' + this.posts);

                    if(this.posts.length === rd.length){
                        this.isLoading = false
                    }
                })
            },

            postsByCategory(category_slug){
                this.postFilterdByCat = true;
                this.category_slug = category_slug;

                if(this.postFilterdByCat && this.postFilterdByTag){
                    this.getfilteredPostCatTag(this.category_slug, this.tag_slug);

                }else{
                    this.getFilteredPost('/post-per-categoria/', category_slug);
                }

            },

            postsByTag(tag_slug){
                this.postFilterdByTag = true;
                this.tag_slug = tag_slug;

                if(this.postFilterdByCat && this.postFilterdByTag){
                    this.getfilteredPostCatTag(this.category_slug, this.tag_slug);

                }else{
                    this.getFilteredPost('/post-per-tag/', tag_slug);
                }
            },

            disableCatFilter(){
                this.category_slug = '';
                this.postFilterdByCat = false;

                if(this.tag_slug){
                    this.postsByTag(this.tag_slug);
                }else{
                    this.getApi(1);
                }
            },

            disableTagFilter(){
                this.tag_slug = '';
                this.postFilterdByTag = false;

                if(this.category_slug){
                    this.postsByCategory(this.category_slug);
                    console.log('sono una sirena');
                }else{
                    this.getApi(1);
                }
            }
        },

        mounted(){
            this.getApi(1);
        }
    }
</script>

<style lang="scss" scoped>

</style>
