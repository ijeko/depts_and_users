<template>
    <div>
        <logo-component :isEditable=true :img=newFile @upload="uploadFile"></logo-component>
        <div class="mb-3">
            <label for="nameInput" class="form-label">Имя <span class="text-danger"
                                                                v-if="errors.name">{{ errors.name[0] }}</span></label>
            <input
                type="text"
                class="form-control"
                id="nameInput"
                placeholder="Название отдела"
                v-model="newName"
            >
        </div>
        <div class="mb-3">
            <label for="deptDescription" class="form-label">Описание</label>
            <textarea class="form-control" id="deptDescription" rows="3" v-model="newDescription"></textarea>
        </div>
        <editable-user-list-item :attachedUsers=attachedUsers @setUsers=setCheckedUsers></editable-user-list-item>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" :disabled="!isChanged" @click="onSubmit">Сохранить</button>
            <a type="button" class="btn btn-secondary" :href="'/depts'">Назад</a>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import LogoComponent from "./Components/LogoComponent";
import EditableUserListItem from "./Components/EditableUserListItem";

export default {
    name: "deptEdit",
    components: {EditableUserListItem, LogoComponent},
    data() {
        return {
            newName: '',
            newDescription: '',
            newFile: '',
            attachedUsers: [],
            isUsersChanged: false,
            errors: {
                name: [],
                description: [],
            }
        }
    },
    props: {
        dept: {}
    },
    methods: {
        setCheckedUsers(users) {
            this.attachedUsers = users
            this.isUsersChanged = true
        },
        fillDeptData() {
            if (this.dept.id) {
                this.newName = this.dept.name
                this.newDescription = this.dept.description
                this.newFile = this.dept.logo
                this.attachedUsers = this.dept.users
            }
        },
        onSubmit() {
            if (this.dept.id) {
                this.update()
            } else {
                this.create()
            }
        },
        update() {
            axios.put('/depts/' + this.dept.id, {
                id: this.dept.id,
                name: this.newName,
                description: this.newDescription,
                users: this.attachedUsers,
                logo: this.newFile
            })
                .then(response => {
                    this.dept = response.data
                    this.fillDeptData()
                })
                .catch(error => {
                    console.log(error.response.data)
                    return this.errors = error.response.data.errors
                })
        },
        create() {
            axios.post('/depts', {
                name: this.newName,
                description: this.newDescription,
                users: this.attachedUsers,
                logo: this.newFile
            })
                .then(response => {
                    console.log(response)
                    this.dept = response.data
                    this.redirect()
                })
                .catch(error => {
                    console.log(error.response.data)
                    return this.errors = error.response.data.errors
                })
        },
        redirect() {
            window.location = "/depts/detail/" + this.dept.id
        },

        uploadFile(fileObject) {
            let formData = new FormData();
            formData.append('file', fileObject);
            axios.post('/file/upload',
                formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                this.newFile = response.data.file
            })
                .catch(error => {
                    console.log('upload fails', error.response.data);
                });
        },
    },
    computed: {
        isChanged() {
            return !!(this.newName !== this.dept.name || this.newDescription !== this.dept.description || this.newFile !== this.dept.logo || this.isUsersChanged);
        },
    },
    mounted() {
        this.fillDeptData()
    }
}
</script>

<style scoped>

</style>
