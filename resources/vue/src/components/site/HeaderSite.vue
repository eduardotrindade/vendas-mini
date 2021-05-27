<template>
  <header class="py-3 bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12"></div>
        <div class="col-md-4 col-sm-6 text-center">
          <img src="../../assets/logo.png" alt="MINISITIO" height="150">
        </div>
        <div class="col-md-4 col-sm-6 pt-4">
          <p class="d-flex justify-content-end align-items-end mt-3">
            <span class="badge badge-warning badge-baixe-o-app" id="headerBaggeBaixeApp">BAIXE O APP</span>
          </p>
          <a
            class="d-flex justify-content-end align-items-end"
            href="https://play.google.com/store/apps/details?id=net.mycardcity"
            target="_blank"
          >
            <img src="../../assets/img/google-play-badge.png" id="headerImgBaixeApp" alt="Disponível no Google Play">
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
#headerImgBaixeApp {
  width: 123px;
}
@media (max-width: 576px) {
  .col-sm-6 {
    width: 50%;
    padding-left: 10px;
    padding-right: 10px;
  }
  p {
    margin-bottom: 0.5rem;
  }
  #headerBaggeBaixeApp {
    font-size: 90%;
  }
  #headerImgBaixeApp {
    width: 100px;
  }
}
</style>
