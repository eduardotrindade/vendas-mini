<template>
  <div>
    <h2 class="mb-3">Representantes</h2>
    <div class="table-responsive">
      <table id="people-list" class="table table-striped table-sm">
        <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Celular</th>
          <th>Status</th>
          <th>Perfil</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="person in people" :key="person.id">
          <td>{{ person.name }}</td>
          <td>{{ person.email }}</td>
          <td>{{ person.cellphone }}</td>
          <td>{{ person.is_active ? 'Ativo' : 'Inativo' }}</td>
          <td>{{ person.profile.name ? person.profile.name : 'Não definido' }}</td>
        </tr>
        </tbody>
      </table>
      <b-pagination
        size="sm"
        class="mt-4"
        align="center"
        aria-controls="people-list"
        v-model="pagination.currentPage"
        :total-rows="pagination.totalRows"
        :per-page="pagination.perPage"
        @change="paginate"
      ></b-pagination>
    </div>
  </div>
</template>

<script>
import PeopleApi from '@/api/people'

export default {
  name: "PeopleList",

  data() {
    return {
      people: {},
      filters: {},
      pagination: {}
    }
  },

  methods: {
    getAll(filters) {
      PeopleApi.getAll(filters).then(this.setResults)
    },

    setResults(result) {
      this.people = result.data
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
