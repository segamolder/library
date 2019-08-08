<template>
    <div class="container-fluid">
        <div class="filter_buttons">
            <div class="filter_button">
                <input type="radio" id="one" value="title" v-model="picked_filter">
                <label for="one">Название</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="two" value="author" v-model="picked_filter">
                <label for="two">Автор</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="three" value="category" v-model="picked_filter">
                <label for="three">Категория</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="four" value="publish" v-model="picked_filter">
                <label for="four">Год издания</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="five" value="bookcase" v-model="picked_filter">
                <label for="five">Шкаф</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="six" value="shelve" v-model="picked_filter">
                <label for="six">Полка</label>
            </div>
            <div class="filter_button">
                <input type="radio" id="seven" value="place" v-model="picked_filter">
                <label for="seven">Место</label>
            </div>
        </div>
        <div class="input-group search">
            <span class="input-group-addon">Поиск</span>
            <input v-model="search" type="text" class="form-control">
        </div>
        <div class="books">
            <div v-for="book in filteredList" class="book-item">
                <p>Автор: <i>{{book.author[0].name}}</i></p>
                <p v-if="book.category.length !== 0">Категория: <i v-for="category_item in book.category">{{category_item[0].name}}
                    | </i></p>
                <p>Название: <i>{{book.title}}</i></p>
                <p>Год издания: <i>{{new Date(book.publishing_year.date).toLocaleString("ru", { year: 'numeric', month:
                    'long' })}}</i></p>
                <p>Шкаф: <i>{{book.place[0].case}}</i></p>
                <p>Полка: <i>{{book.place[0].shelve}}</i></p>
                <p>Место: <i>{{book.place[0].place}}</i></p>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "books.vue",
        data() {
            return {
                books: [],
                search: '',
                picked_filter: "author"
            }
        },
        computed: {
            filteredList() {
                switch (this.picked_filter) {
                    case "title":
                       return this.books.filter(books => {
                            return books.title.toLowerCase().includes(this.search.toLowerCase())
                        })
                    case "author":
                        return this.books.filter(books => {
                            return books.author[0].name.toLowerCase().includes(this.search.toLowerCase())
                        })
                    case "category":
                        return this.books.filter(books => {
                            return books.category.some(n => n.every(k => k.name.toLowerCase().includes(this.search.toLowerCase())))
                        })
                    case "publish":
                        return this.books.filter(books => {
                            return books.publishing_year.date.toLowerCase().includes(this.search.toLowerCase())
                        })
                    case "bookcase":
                        return this.books.filter(books => {
                            return books.place[0].case.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                    case "shelve":
                        return this.books.filter(books => {
                            return books.place[0].shelve.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                    case "place":
                        return this.books.filter(books => {
                            return books.place[0].place.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                }

            }
        },
        methods: {
            getBooks() {
                let self = this;
                axios.get('/books/getall').then(function (response) {
                    self.books = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        },
        created() {
            this.getBooks();
        }
    }
</script>

<style scoped>
    .books {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 10px;
    }

    .book-item {
        width: inherit;
        height: auto;
        border: 1px solid #666;
        background-color: white;
        padding: 1vw;
    }

    .search {
        margin-bottom: 1vh;
    }

    .filter_buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
</style>
