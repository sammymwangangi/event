<template>
    <div>
        <h1>Vue Router Testing</h1>

        <button>
            <router-link :to="{ name: 'users' }">Users</router-link>
        </button>

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
