<template>
  <div class="d-flex flex-column h-100" id="app-wrapper">
    <Header/>
    <main role="main" class="flex-shrink-0 mb-3">
      <div class="container">
        <router-view/>
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
  import Header from './components/Header.vue';
  import Footer from './components/Footer.vue';

  export default {
    components: { Header, Footer }
  }
</script>

<style lang="scss">
  @import '~bootstrap/scss/bootstrap.scss';
  @import '~bootstrap-vue/src/index.scss';
</style>
