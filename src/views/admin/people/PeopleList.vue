<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Representantes</h2>
        <router-link class="btn btn-primary" :to="{ name: 'people-form' }">
          Novo Diretor
        </router-link>
      </div>
    </div>
    <div class="table-responsive">
      <table id="people-list" class="table table-hover table-striped table-sm">
        <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Celular</th>
          <th>Status</th>
          <th>Perfil</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="person in people" :key="person.id">
          <td>{{ person.name }}</td>
          <td>{{ person.email }}</td>
          <td>{{ person.cellphone | formatPhone }}</td>
          <td>{{ person.is_active ? 'Ativo' : 'Inativo' }}</td>
          <td>{{ person.profile ? person.profile.name : 'Não definido' }}</td>
          <td>
            <router-link class="btn btn-primary btn-sm" title="Detalhes" :to="{ name: 'people-view', params: { id: person.id } }">
              <font-awesome-icon icon="eye" />
            </router-link>
          </td>
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
