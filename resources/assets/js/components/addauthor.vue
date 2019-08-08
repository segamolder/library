<template>
    <div class="container-fluid">
        <div class="input-group">
            <span class="input-group-addon">Имя автора</span>
            <input v-model="new_author" type="text" class="form-control">
        </div>
        <button @click="setAuthor" class="btn btn-success addButton">Добавить автора</button>
        <hr>
        <h2>Список авторов</h2>
        <ul class="list-group">
            <li v-for="author in authors" class="list-group-item">{{author.name}}</li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "addauthor.vue",
        data() {
            return {
                new_author: null,
                authors: null
            }
        },
        computed: {

        },
        methods: {
            setAuthor() {
                let data = {
                    new_author: this.new_author
                };
                axios.post('/librarian/set/author', data, {})
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
                this.getAuthors();
                this.new_author = "";
            },
            getAuthors() {
                let self = this;
                axios.get('/librarian/get/author').then(function (response) {
                    self.authors = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getAuthors();
        }
    }
</script>

<style scoped>
    .addButton {
        margin-top: 2vh;
    }
</style>
