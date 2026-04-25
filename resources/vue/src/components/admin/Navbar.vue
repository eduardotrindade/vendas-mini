<template>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 font-weight-bold" href="#">
      <img src="../../assets/logo.png" alt="MINISITIO" height="30">
    </a>
    <button class="navbar-toggler position-absolute d-md-none" type="button" v-b-toggle:sidebarMenu>
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <font-awesome-icon icon="user-circle" />
        {{ user.name }}
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Navbar',

  computed: {
    ...mapGetters(['user']),
  },
}
</script>

<style scoped>
.bg-dark {
  background-color: #ffcc29 !important;
}
</style>
