<template>
    <div class="container-fluid">
        <h1>
            Список учеников
            <button @click="redirect()" class="btn btn-success addButton">Добавить ученика</button>
        </h1>
        <ul class="list-group">
            <li v-for="student in students" class="list-group-item">
                <p><i>Имя: </i>{{student.name}}</p>
                <p><i>Фамилия: </i>{{student.surname}}</p>
                <p><i>Отчество: </i>{{student.lastname}}</p>
                <p><i>Класс: </i>{{student.studentclass}}</p>
                <button @click="" class="btn btn-primary addButton">Редактировать</button>
                <ul class="list-group">
                    <li class="list-group-item" v-for="book in student.books">
                        Автор: {{book.author}} || Название: {{book.title}}
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "students.vue",
        data() {
            return {
                students: null
            }
        },
        computed: {},
        methods: {
            redirect() {
                document.location.href = "/librarian/addstudent";
            },
            getStudents() {
                let self = this;
                axios.get('/librarian/get/students').then(function (response) {
                    self.students = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getStudents();
        }
    }
</script>

<style scoped>
.addButton {
    margin-bottom: 2vh;
}
</style>
