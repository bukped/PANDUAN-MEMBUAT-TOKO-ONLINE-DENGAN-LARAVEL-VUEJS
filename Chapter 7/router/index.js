import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProductView from '../views/ProductView.vue'
import ShoppingCartView from '../views/ShoppingCartView.vue'
import SuccessView from '../views/SuccessView.vue'
import MainView from '../views/MainView.vue'
import FirstView from '../views/FirstView.vue'
import ProfileView from '../views/ProfileView.vue'
import HistoryView from '../views/HistoryView.vue'
import DetailView from '../views/DetailView.vue'
import authGuard from './authGuard'

Vue.use(VueRouter)

const routes = [

  {
    path: '/',
    name: 'HomeView',
    component: HomeView,
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue'),
    beforeEnter: authGuard
  },
  {
    path: '/product/:id',
    props: true,
    name: 'product',
    component: ProductView,
    // beforeEnter: authGuard
  },
  {
    path: '/shopping',
    name: 'ShoppingCartView',
    component: ShoppingCartView,
    // beforeEnter: authGuard
  },
  {
    path: '/success',
    name: 'SuccessView',
    component: SuccessView,
    beforeEnter: authGuard
  },
  {
    path: '/main',
    name: 'MainView',
    component: MainView,
    // beforeEnter: authGuard
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    // beforeEnter: authGuard
  },
  {
    path: '/profile',
    name: 'ProfileView',
    component: ProfileView,
    beforeEnter: authGuard
  },
  {
    path: '/history',
    name: 'HistoryView',
    component: HistoryView,
    beforeEnter: authGuard
  },
  {
    path: '/historyDetail/:id',
    props: true,
    name: 'DetailView',
    component: DetailView,
    beforeEnter: authGuard
  },
  {
    path: '/auth',
    name: 'FirstView',
    component: FirstView,
    // beforeEnter: authGuard
  },
]

const router = new VueRouter({
  routes
})

export default router
