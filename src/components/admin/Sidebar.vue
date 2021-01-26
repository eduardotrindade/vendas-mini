<template>
  <b-collapse tag="nav" id="sidebarMenu" ref="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item" v-for="(link, index) in links" :key="index">
          <router-link class="nav-link" :class="{ 'active': link.active }" :to="{ name: link.route }">
            <font-awesome-icon :icon="link.icon" />
            {{ link.name }}
          </router-link>
        </li>
      </ul>
      <hr>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="javascript:;" @click="logout">
            <font-awesome-icon icon="power-off" />
            Sair
          </a>
        </li>
      </ul>
    </div>
  </b-collapse>
</template>

<script>
export default {
  name: 'Sidebar',

  data() {
    return {
      links: [
        {
          name: 'Compras',
          icon: 'shopping-cart',
          route: 'orders-list',
          active: false
        },
        {
          name: 'Representantes',
          icon: 'users',
          route: 'people-list',
          active: false
        }
      ]
    }
  },

  methods: {
    setActive(route) {
      this.links.map(link => {
        link.active = link.route === route
      })

      let elSidebarMenu = this.$refs.sidebarMenu
      if (elSidebarMenu.$el.style.display !== 'none') {
        this.$root.$emit('bv::toggle::collapse', 'sidebarMenu')
      }
    },

    async logout(){
      await this.$store.dispatch('logout')
      this.$router.push({ name: 'login' })
    }
  },

  mounted() {
    this.setActive(this.$route.name)
  },

  watch: {
    '$route' () {
      this.setActive(this.$route.name)
    }
  }
}
</script>
