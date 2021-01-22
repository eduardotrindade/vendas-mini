<template>
  <div class="d-flex flex-column h-100" id="app-wrapper">
    <Header />
    <navbar />
    <main role="main" class="flex-shrink-0 mb-3">
      <div class="container">
        <slot />
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from '@/components/Site/Header'
import Navbar from '@/components/Site/Navbar'
import Footer from '@/components/Site/Footer'

export default {
  name: 'Site',
  components: { Header, Navbar, Footer },
}
</script>

<style>
@import '../assets/css/style.css';
@import '../assets/css/icons.css';
</style>
