<template>
    <div class="container">
        <h1 class="text-center">VENUES</h1>
        <div class="row">
            <div v-for="venue in venues" class="col-lg-3 col-md-6 my-1">
                <div class="card shadow border-0 h-auto mb-4">
                    <router-link :to="{ name: 'users' }">
                        <img :src="'/service/car.png'"  class="card-img-top img-fluid" alt="event">
                    </router-link>
                    <div class="card-body p-4">
                        <h5 class="card-title text-left">
                            <!--                        <a href="{{route('events.show', $event->id)}}" class="text-decoration-none text-dark">{{ $event->name }}</a>-->
                            {{venue.name}}
                        </h5>
                        <div class="d-flex flex-row card-subtitle mb-2">
                            <div>
                                <svg width="20px" height="20px" fill="#ef63ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="text-info">
                                <small>{{venue.address}}</small>
                            </div>
                        </div>
                        <p class="font-weight-light text-justify">
                            {{ venue.price }}
                        </p>

                    </div>
                    <div class="card-footer border-0 bg-dark">
                        <div class="d-flex justify-content-between align-items-center bd-highlight">
                            <div class="mr-auto bd-highlight">
                                <a href="" class="card-link btn btn-sm btn-outline-info" data-toggle="modal" data-target="#editModa">Edit</a>
                            </div>
                            <div class="bd-highlight">
                                <a href="" class="card-link btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';
    export default {
        name: "Events",
        data: function () {
            return{
                title: "My Events",
                users: [],
                venues: null
            }
        },
        created() {
            this.loadUsers();
            this.loadVenues();
        },
        methods: {
            loadUsers: function () {
                axios
                    .get('/api/users')
                    .then((response) => {
                        this.users = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            loadVenues: function () {
                axios
                    .get('/api/venues')
                    .then((response) => {
                        this.venues = response.data.data;
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
