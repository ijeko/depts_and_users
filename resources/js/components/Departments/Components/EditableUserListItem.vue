<template>
    <div>
        <div
            class="input-group mb-3"
            v-for="user in users"
            :key=user.id
        >
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="checkbox" :checked=isAttached(user.id) value=""
                       aria-label="Checkbox for following text input"
                       @change="editAttachedUsers(user.id)"

                >
            </div>
            <input type="text" class="form-control"
                   :value="user.name"
                   disabled
                   aria-label="Text input with checkbox">
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "EditableUserListItem",
    data () {
        return {
            users: []
        }
    },
    props: {
        attachedUsers: []
    },
    methods: {
        getAllUsers() {
            axios.get('/users/getlist')
            .then(response => {
                this.users = response.data
            })
        },
        isAttached(id) {
            return this.attachedUsers.find(user => user.id === id)
        },
        editAttachedUsers(id) {
            if (this.attachedUsers.find(user => user.id === id)) {
                let index = this.attachedUsers.findIndex(user => user.id === id)
                if (index > -1) {
                    this.attachedUsers.splice(index, 1);
                }
            } else {
                let item = this.users.find(user => user.id === id)
                this.attachedUsers = this.attachedUsers.concat(item)
            }
            this.$emit('setUsers', this.attachedUsers)
        }
    },
    computed: {

    },
    mounted() {
        this.getAllUsers()
    }
}
</script>

<style scoped>

</style>
