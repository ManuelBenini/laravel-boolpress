<template>
    <div>

        <LoadingComp v-if="isLoading" />

        <div v-else>
            <h1>{{post.title}}</h1>

            <i>{{formatDate}}</i>

            <p>{{post.content}}</p>

            <h3>Categoria: {{post.category.name}}</h3>

            <h3>Tags</h3>
            <ul>
                <li v-for="tag in post.tags" :key="`tag${tag.id}`">{{tag.name}}</li>
            </ul>

            <router-link :to="{name: 'blog'}">Torna a tutti i post</router-link>
        </div>

    </div>
</template>

<script>

    import {apiUrl} from '../../data/apiConfig';
    import LoadingComp from '../partials/LoadingComp.vue';

    export default {
    name: "PostDetailComp",

    components: {
        LoadingComp
    },

    data() {
        return {
            slug: this.$route.params.slug,
            post: [],
            apiUrl,
            isLoading: true
        };
    },
    computed: {
        formatDate() {
            const d = new Date(this.post.updated_at);
            let day = d.getDate();
            let month = d.getMonth();
            const year = d.getFullYear();
            day = this.checkDate(day);
            month = this.checkDate(month);
            const formattedDate = `${day}/${month}/${year}`;
            return formattedDate;
        }
    },
    methods: {
        getApi() {
            axios.get(this.apiUrl + "/dettaglio-post/" + this.slug)
                .then(response => {
                    const rd = response.data;
                    this.post = rd;

                    if(rd.length === this.post.length){
                        this.isLoading = false
                    }
                });
    },
        checkDate(dateToCheck) {
            if (dateToCheck < 10) {
                dateToCheck = "0" + dateToCheck;
            }

            return dateToCheck;
        }
    },
    mounted() {
        this.getApi();
    },

}
</script>

<style lang="scss" scoped>



</style>
