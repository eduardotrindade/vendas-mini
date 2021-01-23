<template>
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">
            <font-awesome-icon icon="home" />
            Dashboard <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'users-list' }">
            <font-awesome-icon icon="file" />
            Usuários
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'orders-list' }">
            <font-awesome-icon icon="shopping-cart" />
            Compras
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'people-list' }">
            <font-awesome-icon icon="users" />
            Representantes
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Sidebar"
}
</script>
