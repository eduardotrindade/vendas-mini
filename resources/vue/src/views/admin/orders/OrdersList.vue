<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Compras</h2>
        <span>
          <a class="btn btn-secondary ml-1" :href="linkExportFile" target="_blank">
            Exportar
          </a>
        </span>
      </div>
    </div>
    <div class="table-responsive">
      <table id="orders-list" class="table table-striped table-sm">
        <thead>
        <tr>
          <th>#</th>
          <th>Item</th>
          <th>Valor</th>
          <th>Status</th>
          <th>Criado</th>
          <th>Informação</th>
          <th>Representante</th>
          <th>Perfil</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>{{ order.product.description }}</td>
          <td>{{ order.amount_paid | formatMoney }}</td>
          <td>{{ order.status ? 'Pago' : 'Aguardando Pagamento' }}</td>
          <td>{{ order.created_at | formatDate }}</td>
          <td>{{ order.information }}</td>
          <td>{{ order.people.name }}</td>
          <td>{{ order.people.profile.name }}</td>
        </tr>
        </tbody>
      </table>
      <b-pagination
        size="sm"
        class="mt-4"
        align="center"
        aria-controls="orders-list"
        v-model="pagination.currentPage"
        :total-rows="pagination.totalRows"
        :per-page="pagination.perPage"
        @change="paginate"
      ></b-pagination>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import OrderApi from '@/api/order'

export default {
  name: 'OrdersList',

  computed: {
    ...mapGetters(['user']),
    linkExportFile() {
      return `${this.baseUrl}/orders/export?token=${this.token}`
    }
  },

  data() {
    return {
      baseUrl: null,
      token: null,
      orders: {},
      filters: {},
      pagination: {}
    }
  },

  methods: {
    getAll(filters) {
      OrderApi.getAll(filters).then(this.setResults)
    },

    setResults(result) {
      this.orders = result.data
      this.pagination = {
        currentPage: result.meta.current_page,
        totalRows: result.meta.total,
        perPage: result.meta.per_page
      }
    },

    paginate(page) {
      let filters = Object.assign({}, this.filters, {page})
      this.getAll(filters)
    },

    exportFile() {
      OrderApi.exportFile()
    },
  },

  created() {
    this.baseUrl = process.env.VUE_APP_API_BASE_URL;
    this.token = this.user.access_token;

    this.getAll(this.filters)
  }
}
</script>
