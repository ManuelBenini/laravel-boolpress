<template>
    <div>

        <ul>
            <li>
                <h3><router-link :to="{ name: 'detail', params: {slug: post.slug} }">{{post.title}}</router-link></h3>
                <i>{{formatDate}}</i>
                <p>{{post.content.substr('0', '50')}}...</p>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        name: 'PostItemComp',

        props:{
            post: Object
        },

        computed:{
            formatDate(){
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

        methods:{
            checkDate(dateToCheck){
                if(dateToCheck < 10) { dateToCheck = '0' + dateToCheck};

                return dateToCheck;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
