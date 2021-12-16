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

export default {
    name: "UserItem",
    props: {
        user: {}
    },
    methods: {
        onDelete(id) {
            this.$emit('delete', id)
        }
    }
}
</script>

<style scoped>

</style>
