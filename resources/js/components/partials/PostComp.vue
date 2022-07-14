<template>
    <div>

        <ul>
            <li>
                <h3>{{post.title}}</h3>
                <p>{{post.content}}</p>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        name: 'PostComp',

        props:{
            post: Object
        }
    }
</script>

<style lang="scss" scoped>

</style>
