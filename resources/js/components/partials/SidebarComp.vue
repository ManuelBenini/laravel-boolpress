<template>
    <div class="sidebar">

        <h3>CATEGORIE</h3>

        <ul>
            <li
                v-for="category in categories"
                :key="`cat${category.id}`"
                @click="$emit('postsByCategory', category.slug)">
                {{category.name}}
            </li>
            <li @click="$emit('disableCatFilter')">Annulla filtro per categoria</li>
        </ul>


        <h3>TAGS</h3>

        <ul>
            <li
                v-for="tag in tags"
                :key="`tag${tag.id}`"
                @click="$emit('postsByTag', tag.slug)">
                {{tag.name}}
            </li>
            <li @click="$emit('disableTagFilter')">Annulla filtro per tag</li>
        </ul>

        <h3 @click="$emit('getAllPosts')">Annulla filtri</h3>

    </div>
</template>

<script>
    export default {
        name: 'SidebarComp',

        props:{
            categories: Array,
            tags: Array,
        }
    }
</script>

<style lang="scss" scoped>

    ul{
        li{
            cursor: pointer;
            &:hover{
                text-decoration: underline;
            }
        }
    }
    h3{
        cursor: pointer;
        &:hover{
            text-decoration: underline;
        }
    }

</style>
