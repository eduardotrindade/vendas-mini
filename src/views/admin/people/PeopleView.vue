<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Representante {{ people.name }}</h2>
        <b-dropdown text="Ações" variant="primary" right no-flip>
          <b-dropdown-item>Anexos</b-dropdown-item>
          <b-dropdown-item>Histórico</b-dropdown-item>
          <b-dropdown-item>Pendências</b-dropdown-item>
        </b-dropdown>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="form-group col-12 col-sm-4">
        <label>Perfil:</label>
        <p>{{ people.profile ? people.profile.name : 'Não definido' }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Status:</label>
        <p>{{ people.is_active ? 'Ativo' : 'Inativo' }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Indicado por:</label>
        <p>{{ people.indicated_by }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Nome:</label>
        <p>{{ people.name }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>CPF/CNPJ:</label>
        <p>{{ people.document_number | formatDocumentNumber }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>E-mail:</label>
        <p>{{ people.email }}</p>
      </div>
      <div class="form-group col-12 col-sm-12">
        <label>Endereço:</label>
        <p>
          {{ people.address }} Nº {{ people.number }}
          <span v-if="people.complement">{{ people.complement }}</span>
          <span v-if="people.neighborhood"> - {{ people.neighborhood }}</span>
        </p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Cidade:</label>
        <p>{{ people.city.name }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Estado:</label>
        <p>{{ people.city.state.name }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>CEP:</label>
        <p>{{ people.zip_code | formatZipCode }}</p>
      </div>
      <div class="form-group col-12 col-sm-12">
        <label>Resumo sobre experiência:</label>
        <p>{{ people.resume }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import PeopleApi from '@/api/people'

export default {
  name: 'PeopleView',

  data() {
    return {
      people: {}
    }
  },

  methods: {
    getPeople() {
      PeopleApi.get(this.$route.params.id).then(people => this.people = people)
    },
  },

  created() {
    this.getPeople()
  },

  watch: {
    '$route' () {
      this.getPeople()
    }
  }
}
</script>

<style scoped>
label {
  font-weight: bold;
}
</style>
