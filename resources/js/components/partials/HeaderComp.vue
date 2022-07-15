<template>
    <header>

        <ul class="list-unstyled d-flex justify-content-center">
            <li class="mx-2"><router-link :to="{name: 'home'}">Home</router-link></li>
            <li class="mx-2"><router-link :to="{name: 'about'}">Chi siamo</router-link></li>
            <li class="mx-2"><router-link :to="{name: 'blog'}">Blog</router-link></li>
            <li class="mx-2"><router-link :to="{name: 'contacts'}">Contatti</router-link></li>
        </ul>

    </header>
</template>

<script>
    export default {
        name: 'HeaderComp'
    }
</script>

<style lang="scss" scoped>

    header{
        padding: 20px;
        height: 60px;
        background-color: white;
        .active{
            color: red;
        }
    }

</style>
