import Vue from 'vue'
import VueRouter from 'vue-router'

import HomePage from '../views/HomePage.vue'
import Cadastro from '../views/Cadastro.vue'
import VendaAfiliado from '../views/VendaAfiliado.vue'
import VendaMaster from '../views/VendaMaster.vue'
import VendaFinalizar from '../views/VendaFinalizar.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
  },
  {
    path: '/cadastro',
    name: 'cadastro',
    component: Cadastro,
  },
  {
    path: '/venda/afiliado',
    name: 'venda-afiliado',
    component: VendaAfiliado,
  },
  {
    path: '/venda/master',
    name: 'venda-master',
    component: VendaMaster,
  },
  {
    path: '/venda/finalizar',
    name: 'venda-finalizar',
    component: VendaFinalizar,
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router
