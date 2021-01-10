import Vue from 'vue'
import VueRouter from 'vue-router'

import HomePage from '@/views/HomePage'
import Products from '@/views/Products'
import VendaFinalizar from '@/views/VendaFinalizar'
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
    path: '/venda/finalizar',
    name: 'venda-finalizar',
    component: VendaFinalizar,
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
