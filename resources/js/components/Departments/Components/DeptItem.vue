<template>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action list-group-item-light">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <logo-component :img=dept.logo></logo-component>
                    </div>
                    <div class="col-4 d-block" >
                        <div>{{ dept.name }}</div>
                        <div>{{ dept.description }}</div>
                    </div>
                    <div class="col-3">
                        <user-list-item :usersInDept="dept.users"></user-list-item>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-link text-success" :href="'/depts/detail/'+dept.id">Править</a>
                        <button class="btn btn-link text-danger" @click="onDelete(dept.id)">Удалить</button>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>

import UserListItem from "./UserListItem";
import LogoComponent from "./LogoComponent";
import axios from "axios";

export default {
    name: "DeptItem",
    components: {LogoComponent, UserListItem},
    props: {
        dept: {}
    },
    methods: {
        onDelete(id) {
            axios.delete('/depts/'+id)
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
