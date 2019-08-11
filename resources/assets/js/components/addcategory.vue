<template>
    <div class="container-fluid">
        <div class="input-group">
            <span class="input-group-addon">Название категории</span>
            <input v-model="new_category" type="text" class="form-control">
        </div>
        <button @click="setCategory" class="btn btn-success addButton">Добавить категорию</button>
        <hr>
        <h2>Список категорий</h2>
        <ul class="list-group">
            <li v-for="category in categories" class="list-group-item">{{category.name}}
                <button @click="deleteCategory(category.id)" class="btn btn-danger badge">Удалить</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "addcategory.vue",
        data() {
            return {
                new_category: null,
                categories: null
            }
        },
        computed: {},
        methods: {
            deleteCategory(id) {
                let data = {
                    id: id
                };
                axios.post('/librarian/delete/category', data, {})
                    .then(response => {
                        console.log(response);
                        this.getCategories();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            setCategory() {
                let data = {
                    new_category: this.new_category
                };
                axios.post('/librarian/set/category', data, {})
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
                this.getCategories();
                this.new_category = "";
            },
            getCategories() {
                let self = this;
                axios.get('/librarian/get/category').then(function (response) {
                    self.categories = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getCategories();
        }
    }
</script>

<style scoped>
    .addButton {
        margin-top: 2vh;
    }
</style>
