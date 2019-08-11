<template>
    <div class="container-fluid">
        <h1>Запрошенные книги</h1>
        <ul class="list-group">
            <li v-for="issue in issues" class="list-group-item">
                <span v-if="issue.is_requested == true" style="background-color: green" class="badge">Запрошено</span>
                <span v-else-if="issue.on_hands == true" style="background-color: orange" class="badge">На руках</span>
                <span v-else-if="issue.is_returned == true" class="badge">Возвращено</span>
                <span v-else class="badge">Ошибка</span>
                <P>Автор: <i>{{issue.author}}</i></P>
                <P>Название: <i>{{issue.title}}</i></P>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "requestedbooks.vue",
        data() {
            return {
                issues: null
            }
        },
        computed: {},
        methods: {
            requestedBooks() {
                let self = this;
                axios.get('/librarian/get/issue').then(function (response) {
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
