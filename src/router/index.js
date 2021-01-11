import Vue from 'vue'
import VueRouter from 'vue-router'

import HomePage from '@/views/HomePage'
import Products from '@/views/Products'
import FinalizeOrder from '@/views/FinalizeOrder'
import Cadastro from '@/views/Cadastro'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
  },
  {
    path: '/produtos',
    name: 'products',
    component: Products,
  },
  {
    path: '/finalizar-compra',
    name: 'finalize-order',
    component: FinalizeOrder,
  },
  {
    path: '/cadastro',
    name: 'cadastro',
    component: Cadastro,
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router
