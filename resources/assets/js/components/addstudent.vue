<template>
    <div class="container-fluid">
        <h1>Добавить студента</h1>
        <div class="dropdown">
            <ul class="list-group">
                <li id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"
                    class="list-group-item">
                    {{selected_student.name}} | {{selected_student.email}} | Выбрать аккаунт <span class="caret"></span>
                </li>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li v-for="student in students" @click="selectStudent(student)" class="list-group-item"><a
                            role="menuitem" tabindex="-1" href="#">{{student.name}} | {{student.email}}</a></li>
                </ul>
            </ul>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Имя</span>
            <input v-model="name" type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Фамилия</span>
            <input v-model="surname" type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Отчество</span>
            <input v-model="lastname" type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Класс</span>
            <input v-model="st_class" type="text" class="form-control">
        </div>
        <button @click="setStudent" class="btn btn-success addButton">Добавить ученика</button>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "addstudent.vue",
        data() {
            return {
                students: null,
                selected_student: {
                    name: "",
                    email: "",
                    id: null
                },
                name: null,
                surname: null,
                lastname: null,
                st_class: null
            }
        },
        computed: {

        },
        methods: {
            getStudents() {
                let self = this;
                axios.get('/librarian/get/users').then(function (response) {
                    self.students = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectStudent(student) {
                this.selected_student = student;
            },
            setStudent() {
                let data = {
                    name: this.name,
                    surname: this.surname,
                    lastname: this.lastname,
                    class: this.st_class,
                    user: this.selected_student.id
                };
                axios.post('/librarian/set/student', data, {})
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            }
        },
        created() {
            this.getStudents();
        }
    }
</script>

<style scoped>
    .input-group {
        margin-top: 1vh;
    }

    .addButton {
        margin-top: 1vh;
    }
</style>
