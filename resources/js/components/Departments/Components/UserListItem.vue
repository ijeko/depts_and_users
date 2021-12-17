<template>
        <ol class="list-group list-group-numbered">
            <li class="text-sm-start"
                v-for="user in usersInDept"
                :key="user.id"
            >{{user.name}}</li>
        </ol>
</template>

<script>
export default {
    name: "UserListItem",
    props: {
        usersInDept: {}
    }
}
</script>

<style scoped>

</style>
