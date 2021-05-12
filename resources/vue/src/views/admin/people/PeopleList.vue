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
          <th width="100px"></th>
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
            <router-link class="btn btn-info btn-sm" :to="{ name: 'people-view', params: { id: person.id } }">
              Visualizar
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
import {mapGetters} from 'vuex'
import PeopleApi from '@/api/people'

export default {
  name: "PeopleList",

  computed: {
    ...mapGetters(['user']),
    linkExportFile() {
      return `${this.baseUrl}/people/export?token=${this.token}`
    }
  },

  data() {
    return {
      baseUrl: null,
      token: null,
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
      let filters = Object.assign({}, this.filters, {page})
      this.getAll(filters)
    },

    copyReferralLink(link) {
      this.$clipboard(link);
    },
  },

  created() {
    this.baseUrl = process.env.VUE_APP_API_BASE_URL;
    this.token = this.user.access_token;

    this.getAll(this.filters)
  }
}
</script>
