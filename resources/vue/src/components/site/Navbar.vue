<template>
  <nav class="navbar navbar-expand bg-yellow">
    <div class="container">
      <div class="collapse navbar-collapse justify-content-md-center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link text-uppercase" :to="{ name: 'home' }">Compra de espaços</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link text-uppercase" :to="{ name: 'registration-people' }">Seja nosso representante</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar'
}
</script>

<style scoped>
.bg-yellow {
  background: #ffcc29 url(../../assets/img/bg-navbar.jpg) no-repeat fixed;
}
a {
  color: #000000;
  font-weight: bold;
}
a:hover {
  color: #fff;
}
</style>
