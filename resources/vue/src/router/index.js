import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store'

import Site from '@/layouts/Site'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'landing-page',
    component: () => import(/* webpackChunkName: "site" */ '@/views/LandingPage'),
    meta: { layout: Site },
  },
  {
    path: '/termos-e-politicas-de-privacidade',
    name: 'privacy-policies',
    component: () => import(/* webpackChunkName: "site" */ '@/views/PrivacyPoliciesAndTerms'),
    meta: { layout: Site },
  },
  {
    path: '/compra-de-espacos',
    name: 'buy-space',
    component: () => import(/* webpackChunkName: "site" */ '@/views/BuySpace'),
    meta: { layout: Site },
  },
  {
    path: '/produtos',
    name: 'products',
    component: () => import(/* webpackChunkName: "site" */ '@/views/Products'),
    meta: { layout: Site },
  },
  {
    path: '/finalizar-compra',
    name: 'finalize-order',
    component: () => import(/* webpackChunkName: "site" */ '@/views/FinalizeOrder'),
    meta: { layout: Site },
  },
  {
    path: '/feedback',
    name: 'feedback',
    component: () => import(/* webpackChunkName: "site" */ '@/views/PaymentFeedback'),
    meta: { layout: Site },
  },
  {
    path: '/seja-nosso-representante/:indicated_by?',
    name: 'registration-people',
    component: () => import(/* webpackChunkName: "site" */ '@/views/RegistrationPeople'),
    meta: { layout: Site },
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '@/views/admin/Login'),
    meta: { layout: Site },
  },
  {
    path: '/reset-password/:token',
    name: 'reset-password',
    component: () => import(/* webpackChunkName: "login" */ '@/views/admin/ResetPassword'),
    meta: { layout: Site },
  },
  {
    path: '/admin',
    name: 'admin',
    component: () => import(/* webpackChunkName: "admin" */ '@/layouts/Admin'),
    meta: { requiresAuth: true },
    redirect: { name: 'orders-list' },
    children: [
      {
        path: 'orders',
        name: 'orders-list',
        component: () => import(/* webpackChunkName: "orders" */ '@/views/admin/orders/OrdersList'),
      },
      {
        path: 'people',
        name: 'people-list',
        component: () => import(/* webpackChunkName: "people" */ '@/views/admin/people/PeopleList'),
      },
      {
        path: 'people/view/:id',
        name: 'people-view',
        component: () => import(/* webpackChunkName: "people" */ '@/views/admin/people/PeopleView'),
      },
      {
        path: 'people/form/:id?',
        name: 'people-form',
        component: () => import(/* webpackChunkName: "people" */ '@/views/admin/people/PeopleFrom'),
      },
    ]
  },
  {
    path: "*",
    component: () => import(/* webpackChunkName: "not-found" */ '@/views/NotFound'),
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (store.getters.isAuthenticated) {
      next()
      return
    }
    next('/login')
  } else {
    next()
  }
})

export default router
