import { createRouter, createWebHistory } from 'vue-router';
import Pacientes from './components/pacientes.vue';
import Profesionales from './components/profesionales.vue';
import Rutinas from './components/rutinas.vue';

const routes = [
    {
        path: "/",
        component: () => import("./components/pacientes.vue"),
    },
    {
        path: "/profesionales",
        component: () => import("./components/profesionales.vue"),
    },
    {
        path: "/rutinas",
        component: () => import("./components/rutinas.vue"),
    },
    {
        path: "/ejercicios",
        component: () => import("./components/ejercicios.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
