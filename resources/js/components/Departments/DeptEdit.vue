<template>
    <div>
        <div class="mb-3">
            <label for="nameInput" class="form-label">Имя <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span></label>
            <input
                type="text"
                class="form-control"
                id="nameInput"
                placeholder="Ваше имя"
                v-model="newName"
            >
        </div>
        <div class="mb-3">
            <label for="emailInput" class="form-label">Email  <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span></label>
            <input
                type="email"
                class="form-control"
                id="emailInput"
                placeholder="name@example.com"
                v-model="newEmail"
            >
        </div>
        <div class="mb-3">
            <label for="passwordInput" class="form-label">Пароль <span class="text-danger" v-if="errors.password">{{errors.password[0]}}</span></label>
            <input
                type="password"
                class="form-control"
                id="passwordInput"
                v-model="newPassword"
            >
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" :disabled="!isChanged" @click="onSubmit">Сохранить</button>
            <a type="button" class="btn btn-secondary" :href="'/users'">Назад</a>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "userEdit",
    data () {
        return {
            newName: '',
            newEmail: '',
            newPassword: '',
            errors: {
                name: [],
                email: [],
                password: []
            }
        }
    },
    props: {
        user: {}
    },
    methods: {
        fillUserData() {
            if (this.user.id) {
                this.newName = this.user.name
                this.newEmail = this.user.email
            }
        },
        onSubmit() {
            if (this.user.id) {
                return this.updateUserData()
            } return this.createNewUser()
        },
        updateUserData() {
            axios.put('/users/'+this.user.id, {
                id: this.user.id,
                name: this.newName,
                email: this.newEmail,
                password: this.newPassword
            })
                .then(response => {
                    console.log(response)
                    this.user = response.data
                    this.fillUserData()
                })
            .catch(error  => {
                console.log(error.response.data)
                return this.errors = error.response.data.errors
            })
        },
        createNewUser() {
            axios.post('/users', {
                name: this.newName,
                email: this.newEmail,
                password: this.newPassword
            })
                .then(response => {
                    console.log(response)
                    this.user = response.data
                    this.fillUserData()
                    this.redirect()
                })
                .catch(error  => {
                    console.log(error.response.data)
                    return this.errors = error.response.data.errors
                })
        },
        redirect() {
            alert(this.user.id)
            window.location="/users/detail/"+this.user.id
        }
    },
    computed: {
        isChanged () {
            return !!(this.newName !== this.user.name || this.newEmail !== this.user.email || this.newPassword !== '');
        }
    },
    mounted() {
        this.fillUserData()
    }
}
</script>

<style scoped>

</style>
