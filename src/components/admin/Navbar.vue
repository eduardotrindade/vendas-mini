<template>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 font-weight-bold" href="#">
      MINISITIO Vendas
    </a>
    <button
      class="navbar-toggler position-absolute d-md-none"
      type="button"
      v-b-toggle:sidebarMenu
    >
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</template>

<script>
export default {
  name: 'Navbar'
}
</script>

<style scoped>
.bg-dark {
  background-color: #ffcc29 !important;
}
</style>
