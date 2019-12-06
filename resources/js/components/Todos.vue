<template>
    <div>
        <!-- form add a new category -->
        <form @submit.prevent="addCategorie()">
            <div class="form-row align-items-center" style="margin-bottom: 2rem;">
                <div class="col-auto">
                    <input v-model="categorie.name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Categorie">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-md mt-0">Add</button>
                </div>
            </div>
        </form>
        <!-- display categories with input and a list of todos -->
         <div class="row">
            <section v-for="(categorie) in categories" v-bind:key="categorie.id" class="col-sm-6 col-md-4">
                    <div class="card" style="margin-bottom: 2rem;">
                        <div class="card-header align-items-center">
                            <h3>{{ categorie.name }}
                                <span @click="deleteCategorie(categorie.id)"  style="font-size: 24px; color: #FF3547;">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </h3>
                            <input  v-on:keyup.enter="addTodo(categorie.id)" type="text" class="form-control" v-bind:id="categorie.id" aria-describedby="name" placeholder="Add a todo">
                        </div>
                        <ul v-for="todo in categorie.todos" v-bind:key="todo.id" class="list-group list-group-flush">
                            <li class="list-group-item">
                                {{ todo.name }}
                                <span @click="deleteTodo(todo.id)"  style="font-size: 14px; color: #FF3547;">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </li>
                        </ul>
                    </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                categorie: {
                    id: '',
                    name: ''
                },
                categorie_id: '',
                todos: [],
                todo: {
                    id: '',
                    name: '',
                    categorie_id: '',
                    check: ''
                },
                todo_id: '',
            }
        },

        created() {
            this.fetchTodos();
        },

        methods: {
            fetchTodos() {
                fetch('api/todos')
                .then(res => res.json())
                .then(res => {
                    this.categories = res.data
                })
            },
            deleteCategorie(id) {
               if (confirm('Are you sure ?')) {
                    fetch(`api/categorie/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.fetchTodos()
                    })
                    .catch(err => alert(err))
               }
            },
            deleteTodo(id) {
               if (confirm('Are you sure ?')) {
                    fetch(`api/todo/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.fetchTodos()
                    })
                    .catch(err => alert(err))
               }
            },
            addCategorie() {
                fetch('api/categorie', {
                method: 'post',
                body: JSON.stringify(this.categorie),
                headers: {
                    'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.clearForm();
                    this.fetchTodos();
                })
                .catch(err => console.log(err));
            },
            addTodo(categorie_id) {
                let val = document.getElementById(categorie_id).value
                fetch(`api/todo/${categorie_id}/${val}`, {
                method: 'post',
                body: JSON.stringify(this.todo),
                headers: {
                    'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.clearInput(categorie_id);
                    this.fetchTodos();
                })
                .catch(err => console.log(err));
            },
            clearForm() {
                this.todo.name = '';
                this.categorie.name = '';
            },
            clearInput(categorie_id) {
                document.getElementById(categorie_id).value = '';
            }
        }
    }
</script>
