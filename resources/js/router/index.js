import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/Login.vue')
    },
    {
        path: '/register',
        name: 'registrasi',
        component: () => import('../views/Register.vue')
    },
    {
        path: '/',
        name: 'dashboard',
        component: () => import('../views/Dashboard.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/absen',
        component: () => import('../views/AbsenList.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/absen/new',
        component: () => import('../views/AbsenForm.vue'),
        meta: { requiresAuth: true, role: 'adm' }
    },
    {
        path: '/absen/:id',
        component: () => import('../views/AbsenForm.vue'),
        meta: { requiresAuth: true, role: 'adm' }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach((to, from, next) => {
    const auth = useAuthStore();

    if (to.meta.requiresAuth && !auth.isAuthenticated) {
        next("/login");
    } else if (to.meta.guest && auth.isAuthenticated) {
        next("/");
    } else {
        next();
    }
});
export default router
