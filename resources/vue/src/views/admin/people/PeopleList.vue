<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Representantes</h2>
        <span>
          <router-link class="btn btn-primary" :to="{ name: 'people-form' }">
            Novo
          </router-link>
          <a class="btn btn-secondary ml-1" :href="linkExportFile" target="_blank">
            Exportar
          </a>
        </span>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 col-md-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <font-awesome-icon icon="search" />
            </span>
          </div>
          <input
            type="text"
            class="form-control"
            placeholder="Buscar por nome, CPF/CNPJ ou e-mail..."
            v-model="searchName"
            @keyup.enter="debouncedSearch"
          >
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" @click="applySearch">
              Buscar
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table id="people-list" class="table table-hover table-striped table-sm">
        <thead>
        <tr>
          <th>Nome</th>
          <th>UF</th>
          <th>Cidade</th>
          <th>Indicado por</th>
          <th>Data</th>
          <th>Status</th>
          <th>Perfil</th>
          <th>Link Indicação</th>
          <th width="170px"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="person in people" :key="person.id">
          <td>{{ person.name }}</td>
          <td>{{ person.city.state.abbreviation }}</td>
          <td>{{ person.city.name }}</td>
          <td>{{ person.indicated_by }}</td>
          <td>{{ person.created_at | formatDate }}</td>
          <td>{{ person.is_active ? 'Ativo' : 'Inativo' }}</td>
          <td>{{ person.profile ? person.profile.name : 'Não definido' }}</td>
          <td>
            <button class="btn btn-link" title="Copiar link indicação" @click="copyReferralLink(person.referral_link)" v-if="person.referral_link.length">
              <font-awesome-icon icon="copy" />
              Copiar link
            </button>
          </td>
          <td>
            <router-link class="btn btn-info btn-sm mr-1" :to="{ name: 'people-view', params: { id: person.id } }">
              Visualizar
            </router-link>
            <button class="btn btn-danger btn-sm" @click="cancel(person)">
              Cancelar
            </button>
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
import {mapGetters} from 'vuex'
import EventBus from '@/event-bus'
import PeopleApi from '@/api/people'

export default {
  name: "PeopleList",

  computed: {
    ...mapGetters(['user']),
    linkExportFile() {
      const apiPath = this.baseUrl.replace(window.location.origin, '');
      const fullUrl = `${window.location.origin}${apiPath}`;
      return `${fullUrl}/people/export?token=${this.token}`
    }
  },

  data() {
    return {
      baseUrl: null,
      token: null,
      people: {},
      filters: {},
      pagination: {},
      searchName: '',
      searchTimeout: null
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
      let filters = Object.assign({}, this.filters, {page})
      this.getAll(filters)
    },

    debouncedSearch() {
      clearTimeout(this.searchTimeout)
      this.searchTimeout = setTimeout(() => {
        this.applySearch()
      }, 300)
    },

    applySearch() {
      clearTimeout(this.searchTimeout)
      this.$set(this.filters, 'name', this.searchName.trim())
      delete this.filters.page
      this.getAll(this.filters)
    },

    copyReferralLink(link) {
      this.$clipboard(link);
    },

    cancel(people) {
      if (!confirm('Deseja cancelar este representante?')) return

      PeopleApi.cancel(people).then(() => {
        this.getAll({})
        EventBus.$emit('alert-success', 'Representante cancelado com sucesso!')
      }).catch(error => {
        let errors = error.data.errors
        this.setValidationErrors(errors)
        return Promise.reject(error)
      })
    },
  },

  created() {
    this.baseUrl = process.env.VUE_APP_API_BASE_URL;
    this.token = this.user.access_token;

    this.getAll(this.filters)
  }
}
</script>
