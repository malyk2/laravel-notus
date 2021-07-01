import { createWebHistory, createRouter } from "vue-router";
import Index from './Views/Index.vue'

const routes = [
    {
        path: "/",
        component: Index,
    },
]

export default createRouter({
    history: createWebHistory(),
    routes,
});
