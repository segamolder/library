<template>
    <div class="container-fluid">
        <div class="dropdown">
            <ul class="list-group">
                <li id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"
                    class="list-group-item">
                    {{selected_author.name}} | Выбрать автора <span class="caret"></span>
                </li>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li v-for="author in authors" @click="selectAuthor(author)" class="list-group-item"><a
                            role="menuitem" tabindex="-1" href="#">{{author.name}}</a></li>
                </ul>
            </ul>
        </div>

        <div class="dropdown">
            <ul class="list-group">
                <li id="catLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"
                    class="list-group-item">
                    <span v-for="onecategory in selected_category">{{onecategory.name}} | </span> Выбрать категорию <span class="caret"></span>
                </li>
                <ul class="dropdown-menu" role="menu" aria-labelledby="catLabel">
                    <li v-for="category in categories" @click="selectCategory(category)" class="list-group-item"><a
                            role="menuitem" tabindex="-1" href="#">{{category.name}}</a></li>
                </ul>
            </ul>
        </div>

        <div class="input-group">
            <span class="input-group-addon">Название книги</span>
            <input v-model="title" type="text" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Год издания</span>
            <input v-mask="'####-##-##'" placeholder="YYYY-MM-DD" v-model="publishing_year" type="text"
                   class="form-control">
        </div>
        <button @click="setBook" class="btn btn-success addButton">Добавить книгу</button>

        <hr>

        <ul class="list-group">
            <li v-for="book in books" class="list-group-item book">
                <p>Автор: <i>{{book.author[0].name}}</i></p>
                <p v-if="book.category.length !== 0">Категория: <i v-for="category_item in book.category">{{category_item[0].name}} | </i></p>
                <p>Название: <i>{{book.title}}</i></p>
                <p>Год издания: <i>{{new Date(book.publishing_year.date).toLocaleString("ru", { year: 'numeric', month: 'long' })}}</i></p>
                <p>Шкаф: <i>{{book.place[0].case}}</i></p>
                <p>Полка: <i>{{book.place[0].shelve}}</i></p>
                <p>Место: <i>{{book.place[0].place}}</i></p>
            </li>

        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "addbook.vue",
        data() {
            return {
                authors: null,
                selected_author: {
                    name: ""
                },
                title: null,
                publishing_year: null,
                books: null,
                categories: null,
                selected_category: []
            }
        },
        computed: {},
        methods: {
            getAuthors() {
                let self = this;
                axios.get('/librarian/get/author').then(function (response) {
                    self.authors = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            getBooks() {
                let self = this;
                axios.get('/books/getall').then(function (response) {
                    self.books = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectAuthor(author) {
                this.selected_author = author;
            },
            setBook() {
                let data = {
                    title: this.title,
                    author: this.selected_author.id,
                    categories: this.selected_category,
                    publishing_year: this.publishing_year
                };
                axios.post('/librarian/set/book', data, {})
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            getCategory() {
                let self = this;
                axios.get('/librarian/get/category').then(function (response) {
                    self.categories = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectCategory(category) {
                if (this.selected_category.includes(category)) {
                    this.selected_category.splice(this.selected_category.indexOf(category), 1);
                } else {
                    this.selected_category.push(category);
                }
            }
        },
        created() {
            this.getAuthors();
            this.getCategory();
            this.getBooks();
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

    .book {
        margin-top: 1vh;
    }
</style>
