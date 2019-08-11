<template>
    <div class="container-fluid">
        <h1>Справочная информация</h1>
        <p>Количество книг в библиотеке: <i>{{info.countbooks}}</i></p>
        <p>Количество книг на руках: <i>{{info.onhandbooks}}</i></p>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "libraryinfo.vue",
        data() {
            return {
                info: {
                    countbooks: null,
                    onhandbooks: null
                }
            }
        },
        computed: {},
        methods: {
            getInfo() {
                let self = this;
                axios.get('/info/getall').then(function (response) {
                    self.info = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getInfo();
        }
    }
</script>

<style scoped>

</style>
