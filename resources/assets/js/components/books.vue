<template>
    <div class="container-fluid">
        <div class="container-fluid">
            <h1>Список книг
                <button v-if="is_student === '0'" @click="redirect()" class="btn btn-success addButton">Добавить книгу</button>
                <span v-else></span>
            </h1>
        </div>
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
        <div class="filter_buttons">
            <div class="filter_button"><i>Фильтр:
                <i v-if="sort_reverse" class="fas fa-arrow-down"></i>
                <i v-else class="fas fa-arrow-up"></i>
            </i></div>
            <div class="filter_button"><a @click="setCategory('title')" href="#">Название</a></div>
            <div class="filter_button"><a @click="setCategory('author')" href="#">Автор</a></div>
            <div class="filter_button"><a @click="setCategory('category')" href="#">Категория</a></div>
            <div class="filter_button"><a @click="setCategory('publish')" href="#">Год издания</a></div>
            <div class="filter_button"><a @click="setCategory('case')" href="#">Шкаф</a></div>
            <div class="filter_button"><a @click="setCategory('shelve')" href="#">Полка</a></div>
            <div class="filter_button"><a @click="setCategory('place')" href="#">Место</a></div>
        </div>
        <div class="books">
            <div v-for="book in filteredList" class="book-item" v-if="book.is_busy === 0">
                <span v-if="edit_id !== book.id">
                    <p>Автор: <i>{{book.author[0].name}}</i></p>
                    <p v-if="book.category.length !== 0">Категория: <i v-for="category_item in book.category">{{category_item[0].name}}
                        | </i></p>
                    <p>Название: <i>{{book.title}}</i></p>
                    <p>Год издания: <i>{{new Date(book.publishing_year.date).toLocaleString("ru", { year: 'numeric',
                        month:
                        'long' })}}</i></p>
                    <p>Шкаф: <i>{{book.place[0].case}}</i></p>
                    <p>Полка: <i>{{book.place[0].shelve}}</i></p>
                    <p>Место: <i>{{book.place[0].place}}</i></p>
                    <button v-if="is_student === '0'" @click="setEdit(book.id)" class="btn btn-primary addButton">Редактировать</button>
                    <button v-if="is_student === '0'" @click="deleteBook(book.id)" class="btn btn-danger addButton">Удалить</button>
                    <button v-else-if="is_registered_student === 1" @click="request_book(book.id)" class="btn btn-primary addButton">Запросить</button>
                    <span v-else style="color: red">Для запроса книги необходимо создать карточку ученика у библиотекаря</span>
                </span>
                <span v-else>
                    <div class="dropdown">
                        <ul class="list-group">
                            <li id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"
                                class="list-group-item">
                                {{selected_author.name}} | Выбрать автора <span class="caret"></span>
                                                    <span>/ То что изменяем: <i>{{book.author[0].name}}</i></span>

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
                                <span v-for="onecategory in selected_category">{{onecategory.name}} | </span> Выбрать категорию |
                                                                <span class="caret"></span>
                                <span v-if="book.category.length !== 0">/ То что изменяем: <i v-for="category_item in book.category">{{category_item[0].name}} </i></span>
                            </li>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="catLabel">
                                <li v-for="category in categories" @click="selectCategory(category)" class="list-group-item"><a
                                        role="menuitem" tabindex="-1" href="#">{{category.name}}</a></li>
                            </ul>
                        </ul>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">Название книги</span>
                        <input v-model="title" type="text" v-bind:placeholder="book.title" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Год издания</span>
                        <input v-mask="'####-##-##'" v-bind:placeholder="'YYYY-MM-DD :Было: ' + new Date(book.publishing_year.date).toLocaleString('ru', { year: 'numeric',
                        month:
                        'long' })"
                               v-model="publishing_year" type="text"
                               class="form-control">
                    </div>
                    <button @click="setEdit(null)" class="btn btn-success addButton">Сохранить</button>
                    <button @click="setEdit(0)" class="btn btn-error addButton">Отмена</button>
                </span>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "books.vue",
        props: ["is_student"],
        data() {
            return {
                books: [],
                search: '',
                picked_filter: "author",
                picked_sort: "author",
                sort_reverse: false,
                edit_id: null,
                //
                authors: null,
                selected_author: {
                    name: ""
                },
                title: null,
                publishing_year: null,
                categories: null,
                selected_category: [],
                is_registered_student: null
            }
        },
        computed: {
            filteredList() {
                let sort;
                switch (this.picked_filter) {
                    case "title":
                        sort = this.books.filter(books => {
                            return books.title.toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                    case "author":
                        sort = this.books.filter(books => {
                            return books.author[0].name.toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                    case "category":
                        sort = this.books.filter(books => {
                            return books.category.some(n => n.every(k => k.name.toLowerCase().includes(this.search.toLowerCase())))
                        })
                        break;
                    case "publish":
                        sort = this.books.filter(books => {
                            return books.publishing_year.date.toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                    case "bookcase":
                        sort = this.books.filter(books => {
                            return books.place[0].case.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                    case "shelve":
                        sort = this.books.filter(books => {
                            return books.place[0].shelve.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                    case "place":
                        sort = this.books.filter(books => {
                            return books.place[0].place.toString().toLowerCase().includes(this.search.toLowerCase())
                        })
                        break;
                }
                // if (true) {
                //     return sort.sort(function(a, b) {
                //         // return b.place[0].place - a.place[0].place
                //         if (a.title > b.title)
                //             return -1;
                //         if (a.title < b.title)
                //             return 1;
                //         return 0;
                //     });
                // } else {
                //     return sort;
                // }
                switch (this.picked_sort) {
                    case "title":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.title > b.title)
                                    return -1;
                                if (a.title < b.title)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.title < b.title)
                                    return -1;
                                if (a.title > b.title)
                                    return 1;
                                return 0;
                            });
                        }
                    case "author":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.author[0].name > b.author[0].name)
                                    return -1;
                                if (a.author[0].name < b.author[0].name)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.author[0].name < b.author[0].name)
                                    return -1;
                                if (a.author[0].name > b.author[0].name)
                                    return 1;
                                return 0;
                            });
                        }
                    case "category":

                        break;
                    case "publish":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.publishing_year.date > b.publishing_year.date)
                                    return -1;
                                if (a.publishing_year.date < b.publishing_year.date)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.publishing_year.date < b.publishing_year.date)
                                    return -1;
                                if (a.publishing_year.date > b.publishing_year.date)
                                    return 1;
                                return 0;
                            });
                        }
                    case "case":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.place[0].case > b.place[0].case)
                                    return -1;
                                if (a.place[0].case < b.place[0].case)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.place[0].case < b.place[0].case)
                                    return -1;
                                if (a.place[0].case > b.place[0].case)
                                    return 1;
                                return 0;
                            });
                        }
                    case "shelve":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.place[0].shelve > b.place[0].shelve)
                                    return -1;
                                if (a.place[0].shelve < b.place[0].shelve)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.place[0].shelve < b.place[0].shelve)
                                    return -1;
                                if (a.place[0].shelve > b.place[0].shelve)
                                    return 1;
                                return 0;
                            });
                        }
                    case "place":
                        if (this.sort_reverse === false) {
                            return sort.sort(function (a, b) {
                                if (a.place[0].place > b.place[0].place)
                                    return -1;
                                if (a.place[0].place < b.place[0].place)
                                    return 1;
                                return 0;
                            });
                        } else {
                            return sort.sort(function (a, b) {
                                if (a.place[0].place < b.place[0].place)
                                    return -1;
                                if (a.place[0].place > b.place[0].place)
                                    return 1;
                                return 0;
                            });
                        }
                }

            }
        },
        methods: {
            isStudent() {
                let self = this;
                axios.get('/student/isstudent').then(function (response) {
                    self.is_registered_student = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            request_book(id) {
                let data = {
                    id: id,
                };
                axios.post('/librarian/set/issue', data, {})
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            deleteBook(id) {
                let data = {
                    id: id,
                };
                axios.post('/librarian/delete/book', data, {})
                    .then(response => {
                        console.log(response);
                        this.getBooks();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            redirect() {
                document.location.href = "/librarian/addbook";
            },
            setEdit(id) {
                if (id === null) {
                  this.updateBook(this.edit_id);
                }
                this.edit_id = id;
            },
            updateBook(id) {
                let data = {
                    id: id,
                    title: this.title,
                    author: this.selected_author.id,
                    categories: this.selected_category,
                    publishing_year: this.publishing_year
                };
                axios.post('/librarian/update/book', data, {})
                    .then(response => {
                        console.log(response);
                        this.getBooks();
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },
            setCategory(cat) {
                if (this.sort_reverse === false) {
                    this.sort_reverse = true;
                } else {
                    this.sort_reverse = false;
                }
                // if (cat === this.picked_sort) {
                //     this.sort_reverse = true;
                // } else {
                this.picked_sort = cat;
                // }
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
            },
            getAuthors() {
                let self = this;
                axios.get('/librarian/get/author').then(function (response) {
                    self.authors = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            selectAuthor(author) {
                this.selected_author = author;
            }
        },
        created() {
            this.isStudent();
            this.getBooks();
            this.getCategory();
            this.getAuthors();
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
        margin-bottom: 2vh;
    }

    .input-group {
        margin-bottom: 1vh;
    }

    h1 {
        margin-bottom: 2vh;
    }
</style>
