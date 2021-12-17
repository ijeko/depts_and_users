<template>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action list-group-item-light">
            <div class="d-flex justify-content-between">
                <div class="d-block">
                    <div>{{ user.name }}</div>
                    <div>{{ user.email }}</div>
                </div>
                <div>
                    <a class="btn btn-link text-success" :href="'/users/detail/'+user.id">Править</a>
                    <button class="btn btn-link text-danger" @click="onDelete(user.id)">Удалить</button>
                </div>
            </div>
        </a>
    </div>
</template>

<script>

import axios from "axios";

export default {
    name: "UserItem",
    props: {
        user: {}
    },
    methods: {
        onDelete(id) {
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
