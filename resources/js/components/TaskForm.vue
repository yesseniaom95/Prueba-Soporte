<template>   
    <div   class="card card-body">
        <h2 class="text-center mb-3">Create Task</h2>
        <form @submit.prevent="addTask">
            <div class="form-group">
                <input v-model="newTask.title" class="form-control" placeholder="Task Title" required>
            </div>
            <div class="form-group">
                <input v-model="newTask.description" class="form-control" placeholder="Task Description" required>
            </div>
            <div class="form-group">
                <select v-model="newTask.user" required class="custom-select" aria-label="Default select example">
                    <option selected value="">Please select one</option>
                    <option v-for="user in users" :value="user.email" :key="user.email">
                        {{ user.email}}
                    </option>
                </select>   
            </div>       
            <button type="submit" class="btn btn-primary btn-block">Add Task</button>
        </form>
        <button  @click="$emit('created')" class="mt-2 btn btn-light btn-block">Close</button>  
    </div>  
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data() {
        return {
            newTask: {
                title: '',
                description: '',
                user: ''
            }
        };
    },
    computed: {
        ...mapState(['users']), // Simplificado para mapState
      
    },
    methods: {
        ...mapActions(['addTask']),
        addTask() {
            if (!this.newTask.title || !this.newTask.description || !this.newTask.user) {
                alert('Both title and description are required');
                return;
            }
            // Se utiliza la acción 'addTask' y luego se limpia el formulario
            this.$store.dispatch('addTask', this.newTask).then(() => {
                this.newTask.title = '';
                this.newTask.description = '';
                this.newTask.user = '';
                this.$emit('created')
            }).catch(error => {
                console.error('Error adding task:', error);
            });
        }
    },
};
</script>
