import Vue from "vue";
import Vuex from "vuex";
import axios from "axios"; // Asegúrate de tener axios instalado

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        tasks: [], // Estado inicial para las tareas
        users: [], // Estado inicial para los emails de usuarios
    },
    mutations: {
        ADD_TASK(state, task) {
            state.tasks.push(task);
        },
        UPDATE_TASK(state, updatedTask) {
            const index = state.tasks.findIndex((t) => t.id === updatedTask.id);
            if (index !== -1) {
                Vue.set(state.tasks, index, updatedTask);
            }
        },
        COMPLETE_TASK(state, updatedTask) {
            const index = state.tasks.findIndex((t) => t.id === updatedTask.id);
            if (index !== -1) {
                Vue.set(state.tasks, index, updatedTask);
            }
        },
        DELETE_TASK(state, taskId) {
            state.tasks = state.tasks.filter((t) => t.id !== taskId);
        },
        GET_TASKS(state, { tasks, users }) {
            state.tasks = tasks;
            state.users = users;
        },
    },
    actions: {
        addTask({ commit }, task) {
            axios
                .post("/api/tasks", task)
                .then((response) => {
                    commit("ADD_TASK", response.data);
                })
                .catch((error) => {
                    console.error("Error adding task:", error);
                });
        },
        updateTask({ commit }, task) {
            axios
                .put(`/tasks/${task.id}`, task)
                .then((response) => {
                    commit("UPDATE_TASK", response.data);
                })
                .catch((error) => {
                    console.error("Error updating task:", error);
                });
        },
        completeTask({ commit }, taskId) {
            axios
                .patch(`/api/tasks/complete/${taskId}`)
                .then((response) => {
                    commit("COMPLETE_TASK", response.data);
                })
                .catch((error) => {
                    console.error("Error updating task:", error);
                });
        },
        deleteTask({ commit }, taskId) {
            axios
                .delete(`/api/tasks/${taskId}`)
                .then(() => {
                    commit("DELETE_TASK", taskId);
                })
                .catch((error) => {
                    console.error("Error deleting task:", error);
                });
        },
        fetchTasks({ commit }) {
            axios
                .get(`/api/tasks`)
                .then((response) => {
                    return response.data;
                })
                .then((data) => {
                    commit("GET_TASKS", data);
                })
                .catch((error) => {
                    console.error("Error geting tasks:", error);
                });
        },
    },
    getters: {
        tasks: (state) => state.tasks,
    },
});
