<template>
  <header class="py-3 bg-white">
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col text-center">
          <img src="../../assets/logo.png" alt="MINISITIO" height="150">
        </div>
        <div class="col text-right pt-5">
          <p><span class="badge badge-warning badge-baixe-o-app">BAIXE O APP</span></p>
          <a href="https://play.google.com/store/apps/details?id=net.mycardcity" target="_blank">
            <img src="../../assets/img/google-play-badge.png" alt='Disponível no Google Play' height="38">
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header"
}
</script>

<style scoped>
.badge-baixe-o-app {
  font-size: large;
}
</style>
