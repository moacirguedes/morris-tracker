import {createRouter, createWebHistory} from 'vue-router'

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
      path: '/Login',
      name: 'login',
      component: () => import('@/views/RegisterView.vue'),
      meta: {
        title: 'Login'
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = typeof to.meta.title === 'string' ? to.meta.title : 'Default Title'
  next()
})

export default router
