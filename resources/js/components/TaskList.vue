<template>
    <div>
        <div class="container mt-5" v-if="open">
            <task-form @created="closeModal">
                            
            </task-form >
        </div>  
        <div class="container mt-5"  v-if="!open">
            <button type="button" class="btn btn-primary float-right" @click="openModal()">
            Add Task
            </button>       
            <h1 class="text-center mt-4">Task List1</h1>
            <div class="form-group">
                    <select v-model="filter"  required class="custom-select" >
                        <option selected value="">All</option>
                        <option selected value="1">Completed</option>
                        <option selected value="0">Pending</option>
                    </select>   
                </div>
            <ul class="list-group mb-4">
            <task-item v-for="task in filteredTasks" :key="task.id" :task="task">                
                </task-item>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import TaskItem from "./TaskItem.vue";
import TaskForm from "./TaskForm.vue";

export default {
    components: {
        "task-item": TaskItem,
        "task-form":TaskForm
  },
    data() {
        return {
            filter: "",
            open:false
        };
    },
    computed: {
        ...mapState(['tasks']), // Simplificado para mapState
        filteredTasks() {
            return this.tasks.filter((task) => {
                if (this.filter == '') { 
                    return task
                }
                if (this.filter == "0" && task.completed == 0) { 
                    return task
                }
                if (this.filter == "1" && task.completed == 1) { 
                    return task
                }                
            });
        }
    },
    methods: {
        ...mapActions(['fetchTasks']),
       
        getTasks() {
            // Se utiliza la acción 'completeTask'
            this.$store.dispatch('fetchTasks').catch(error => {
                console.error('Error fetching Tasks:', error);
            });
        },
        openModal() {
            this.open = true;
        },
        closeModal() {
            this.open = false;
        }
    },
    mounted() {
        this.getTasks();
    }
};
</script>
