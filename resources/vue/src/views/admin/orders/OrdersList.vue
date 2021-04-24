<template>
  <div>
    <h2 class="mb-3">Compras</h2>
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
import OrderApi from '@/api/order'

export default {
  name: 'OrdersList',

  data() {
    return {
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
        totalRows : result.meta.total,
        perPage   : result.meta.per_page
      }
    },

    paginate(page) {
      let filters = Object.assign({}, this.filters, { page })
      this.getAll(filters)
    },
  },

  created() {
    this.getAll(this.filters)
  }
}
</script>
