import {createRouter, createWebHistory} from 'vue-router';
import NotFound from "./components/NotFound.vue";
import Main from "./components/Main.vue";

const routes = [
    {path: '/', name: 'main', component: Main},
    {path: '/:pathMatch(.*)*', component: NotFound},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
