import Vue from 'vue'
import VueRouter from 'vue-router'

import Site from '@/layouts/Site'
import Admin from '@/layouts/Admin'

import HomePage from '@/views/HomePage'
import Products from '@/views/Products'
import FinalizeOrder from '@/views/FinalizeOrder'
import RegistrationPeople from '@/views/RegistrationPeople'

import UsersList from '@/views/admin/users/UsersList'
import PeopleList from '@/views/admin/people/PeopleList'
import PeopleView from '@/views/admin/people/PeopleView'
import OrdersList from '@/views/admin/orders/OrdersList'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: { layout: Site },
  },
  {
    path: '/produtos',
    name: 'products',
    component: Products,
    meta: { layout: Site },
  },
  {
    path: '/finalizar-compra',
    name: 'finalize-order',
    component: FinalizeOrder,
    meta: { layout: Site },
  },
  {
    path: '/seja-nosso-representante',
    name: 'registration-people',
    component: RegistrationPeople,
    meta: { layout: Site },
  },
  {
    path: '/admin',
    name: 'admin',
    component: Admin,
    children: [
      {
        path: 'users',
        name: 'users-list',
        component: UsersList
      },
      {
        path: 'people',
        name: 'people-list',
        component: PeopleList
      },
      {
        path: 'people/:id',
        name: 'people-view',
        component: PeopleView
      },
      {
        path: 'orders',
        name: 'orders-list',
        component: OrdersList
      },
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router
