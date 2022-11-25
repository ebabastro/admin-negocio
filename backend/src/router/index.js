import { createRouter, createWebHistory } from "vue-router";
import DashboardView from "../views/DashboardView.vue";
import AlmacenesView from "../views/AlmacenesView.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import ProductsView from "../views/ProductsView.vue";
import { nextTick } from "vue";

const routes = [{
    path: '/',
    redirect: '/dashboard',
    component: DefaultLayout,
    children: [
        { path: '/dashboard', name: 'dashboard', component: DashboardView },
        { path: '/almacenes', name: 'almacenes', component: AlmacenesView },
        { path: '/products', name: 'products', component: ProductsView },
    ],
}, ]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;