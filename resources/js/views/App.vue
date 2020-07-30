<template>
    <div>
        <div class="text-center">
            <router-link :to="{ name: 'users' }">Users</router-link>
        </div>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
    }
</script>

<style scoped>

</style>
