<template>
  <div class="d-flex flex-column h-100" id="app-wrapper">
    <Header/>
    <Navbar/>
    <main role="main" class="flex-shrink-0 mb-3">
      <div class="container">
        <router-view/>
      </div>
    </main>
    <Footer />
    <Loading v-show="isLoading"></Loading>
  </div>
</template>

<script>
  import Header from '@/components/Header';
  import Navbar from '@/components/Navbar';
  import Footer from '@/components/Footer';
  import Loading from '@/components/Loading'
  import Toasts  from '@/mixins/toasts'
  import { mapGetters } from 'vuex'

  export default {
    components: { Header, Navbar, Footer, Loading },
    mixins: [ Toasts ],
    computed: {
      ...mapGetters(['isLoading'])
    },
  }
</script>

<style lang="scss">
  @import '~bootstrap/scss/bootstrap.scss';
  @import '~bootstrap-vue/src/index.scss';
</style>

<style>
  @import './assets/css/icons.css';
  @import './assets/css/style.css';
</style>
