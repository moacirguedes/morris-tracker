import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('@/views/HomeView.vue')
    },
    {
      path: '/about',
      name: 'About',
      component: () => import('@/views/AboutView.vue')
    }
  ]
})

router.beforeEach((to, from, next) => {
  const pageTitle = typeof to.name === 'string' ? to.name : 'Default Title'
  document.title = pageTitle
  next()
})

export default router
