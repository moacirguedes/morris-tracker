import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from "@/stores/auth";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('@/views/HomeView.vue'),
            meta: {
                title: 'Home'
            }
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('@/views/AboutView.vue'),
            meta: {
                title: 'About'
            }
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('@/views/LoginView.vue'),
            meta: {
                title: 'Login'
            }
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('@/views/RegisterView.vue'),
            meta: {
                title: 'Register'
            }
        },
    ]
})

router.beforeEach((to, from, next) => {
    const auth = useAuthStore()

    document.title = typeof to.meta.title === 'string' ? to.meta.title : 'Default Title'

    if (auth.loginStatus() && (to.name === 'login' || to.name === 'register')) {
        next({name: "home"});
    } else if (!auth.loginStatus() && to.name !== 'login' && to.name !== 'register') {
        next({name: "login"})
    } else {
        next()
    }
})

export default router
