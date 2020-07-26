<template>
    <div class="container">
        <h1>{{ title }}</h1>
        <ul class="list-group" v-if="users">
            <li
                class="list-group-item"
                v-for="user in users"
                :key="user.id"
            >{{user.name}}</li>
        </ul>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        name: "Events",
        data: function () {
            return{
                title: "My Events",
                users: []
            }
        },
        created() {
            this.loadUsers();
        },
        methods: {
            loadUsers: function () {
                axios
                    .get('/api/users')
                    .then((response) => {
                        this.loading = false;
                        this.users = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>
    h1 {
        color: coral;
    }
</style>
