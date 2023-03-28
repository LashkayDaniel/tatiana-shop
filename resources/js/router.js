import {createRouter, createWebHistory} from 'vue-router';
import NotFound from "./components/NotFound.vue";
import Main from "./components/Main.vue";
import Products from "./components/Products.vue";
import Admin from "./components/admin/Admin.vue";

const routes = [
    {path: '/', name: 'main', component: Main},

    {path: '/products/:slug', name: 'products', component: Products},

    {path: '/a/admin', name: 'admin', component: Admin},

    {path: '/:pathMatch(.*)*', component: NotFound},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
