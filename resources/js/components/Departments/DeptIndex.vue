<template>
    <div>
        <user-item
            v-for="user in users"
            :key="user.id"
            :user="user"
            @delete="deleteUser"
        />
    </div>
</template>

<script>

import UserItem from "./Components/UserItem";
import axios from "axios";

export default {
    name: "userIndex",
    components: {UserItem},
    props: {
        users: {},
    },
    methods: {
        deleteUser(id) {
            axios.delete('/users/'+id)
                .then(response => {
                    window.location = response.data
                })
                .catch(error  => {
                    return error
                })
        }
    }
}
</script>

<style scoped>

</style>
