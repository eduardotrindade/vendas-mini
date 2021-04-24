<template>
  <div>
    <navbar />
    <div class="container-fluid">
      <div class="row">
        <sidebar />
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-md-4">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/admin/Navbar'
import Sidebar from '@/components/admin/Sidebar'

export default {
  name: 'Admin',
  components: { Navbar, Sidebar },
}
</script>

<style>
@import '../assets/css/admin/style.css';
</style>
