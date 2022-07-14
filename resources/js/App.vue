<template>
    <div>

        <HeaderComp/>

        <div class="container">

            <main>
                <router-view></router-view>
            </main>

        </div>

        <FooterComp/>

    </div>
</template>

<script>
    import HeaderComp from './components/partials/HeaderComp.vue';
    import FooterComp from './components/partials/FooterComp.vue';

    export default {
        name: "App",

        components: {
            HeaderComp, FooterComp
        }
    }
</script>

<style lang="scss" scoped>

</style>
