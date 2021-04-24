<template>
  <header class="py-3 bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12"></div>
        <div class="col-md-4 col-sm-12 text-center">
          <img src="../../assets/logo.png" alt="MINISITIO" height="150">
        </div>
        <div class="col-md-4 col-sm-12 pt-4">
          <p class="d-flex justify-content-center justify-content-md-end align-items-center align-items-md-end mt-3">
            <span class="badge badge-warning badge-baixe-o-app">BAIXE O APP</span>
          </p>
          <a
            class="d-flex justify-content-center justify-content-md-end align-items-center align-items-md-end"
            href="https://play.google.com/store/apps/details?id=net.mycardcity"
            target="_blank"
          >
            <img src="../../assets/img/google-play-badge.png" alt='Disponível no Google Play' height="38">
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'HeaderSite'
}
</script>

<style scoped>
.badge-baixe-o-app {
  font-size: large;
}
</style>
