<template>
  <div class="d-flex flex-column h-100" id="app-wrapper">
    <header-site />
    <main role="main" class="flex-shrink-0 mb-3">
      <div class="container">
        <slot />
      </div>
    </main>
    <footer-site />
  </div>
</template>

<script>
import HeaderSite from '@/components/site/HeaderSite'
import Navbar from '@/components/site/Navbar'
import FooterSite from '@/components/site/FooterSite'

export default {
  name: 'Site',
  components: { HeaderSite, Navbar, FooterSite },

  mounted() {

  }
}
</script>

<style>
@import '../assets/css/style.css';
@import '../assets/css/icons.css';
</style>
