<template>
    <div>
        <dept-item
            v-for="dept in depts.items"
            :key="dept.id"
            :dept="dept"
            @delete="deleteDept"
        />
    </div>
</template>

<script>

import axios from "axios";
import DeptItem from "./Components/DeptItem";

export default {
    name: "deptIndex",
    components: {DeptItem},
    props: {
        depts: {},
    },
    methods: {
        deleteDept(id) {
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
