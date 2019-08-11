<template>
<div class="container-fluid">
    <h1>Запрошенные книги</h1>
    <ul class="list-group">
        <li v-for="issue in issues" class="list-group-item">
            <span v-if="issue.is_requested == true" style="background-color: green" class="badge">Запрошено</span>
            <span v-else-if="issue.on_hands == true" style="background-color: orange" class="badge">На руках</span>
            <span v-else class="badge">Ошибка</span>
            <button v-if="issue.is_requested == true" @click="giveout(issue.issued_id)" class="btn btn-success addButton badge">Выдать</button>
            <button v-else-if="issue.on_hands == true" @click="returnbook(issue.issued_id)" class="btn btn-success addButton badge">Вернуть</button>
            <button @click="cancelbook(issue.issued_id)" class="btn btn-danger addButton badge">Отменить</button>

            <P>Автор: <i>{{issue.author}}</i></P>
            <P>Название: <i>{{issue.title}}</i></P>
            <hr>
            <P>Имя студента: <i>{{issue.student_name}}</i></P>
            <P>Фамилия студента: <i>{{issue.student_surname}}</i></P>
            <P>Отчество студента: <i>{{issue.student_lastname}}</i></P>
        </li>
    </ul>
</div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "librarianrequestedbooks.vue",
        data() {
            return {
                issues: null
            }
        },
        computed: {

        },
        methods: {
            giveout(id) {
                let data = {
                    id: id
                };
                axios.post('/librarian/update/issue', data, {})
                    .then(response => {
                        console.log(response);
                        this.requestedBooks();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            returnbook(id) {
                let data = {
                    id: id
                };
                axios.put('/librarian/update/issue', data, {})
                    .then(response => {
                        console.log(response);
                        this.requestedBooks();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            cancelbook(id) {
                let data = {
                    id: id
                };
                axios.post('/librarian/delete/issue', data, {})
                    .then(response => {
                        console.log(response);
                        this.requestedBooks();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            requestedBooks() {
                let self = this;
                axios.get('/librarian/get/allrequestedbooks').then(function (response) {
                    self.issues = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        created() {
            this.requestedBooks();
        }
    }
</script>

<style scoped>

</style>
