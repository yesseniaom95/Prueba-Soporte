<template> 
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">{{ task.title }}</h5>
            <p class="mb-1">{{ task.description }}</p>
            <small class="text-muted">Assigned to: {{ task.user.name }}</small>
        </div>
        <div v-if="task?.completed">            
            <p class="badge badge-primary text-wrap p-3" > 
                <span>Completed</span>
            </p>            
        </div>
        <div v-else>
            <button class="'btn btn-sm mr-2  btn-success pe-auto"  @click="completeTask(task.id)">                        
                Complete
            </button>
            <button v-if="!task?.completed" class="btn btn-danger btn-sm" @click="deleteTask(task.id)">Delete</button>
        </div>
    </li>   
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: ['task'],
    methods: {
        ...mapActions(['completeTask', 'deleteTask']),
        completeTask(taskId) {
            // Se utiliza la acción 'completeTask'
            this.$store.dispatch('completeTask', taskId).catch(error => {
                console.error('Error completing task:', error);
            });
        },
        deleteTask(taskId) {
            // Se utiliza la acción 'deleteTask'
            this.$store.dispatch('deleteTask', taskId).catch(error => {
                console.error('Error deleting task:', error);
            });
        }
    }
};
</script>
