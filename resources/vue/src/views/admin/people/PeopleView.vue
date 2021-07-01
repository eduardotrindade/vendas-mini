<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Representante {{ people.name }}</h2>
        <span>
          <button class="btn mr-3" :class="!people.is_active ? 'btn-primary' : 'btn-danger'" @click="makeActive">
            <span v-if="!people.is_active">Ativar</span>
            <span v-else>Inativar</span>
          </button>
          <router-link class="btn btn-info" :to="{ name: 'people-form', params: { id: people.id } }">
            Editar
          </router-link>
        </span>
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
        <label>Link de indicação:</label>
        <p>{{ people.referral_link }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>E-mail:</label>
        <p>{{ people.email }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Celular <span class="text-muted">(com WhatsApp)</span>:</label>
        <p>{{ people.cellphone | formatPhone }}</p>
      </div>
      <div class="form-group col-12 col-sm-4"></div>
      <div class="form-group col-12 col-sm-4">
        <label>Data de nascimento:</label>
        <p>{{ people.birth_date | formatDate }}</p>
      </div>
      <div class="form-group col-12 col-sm-4">
        <label>Escolaridade:</label>
        <p>{{ people.education }}</p>
      </div>
      <div class="form-group col-12 col-sm-4"></div>
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
    <people-active />
  </div>
</template>

<script>
import EventBus from '@/event-bus'
import PeopleApi from '@/api/people'
import EducationApi from '@/api/education'
import PeopleActive from './PeopleActive'

export default {
  name: 'PeopleView',
  components: { PeopleActive },

  data() {
    return {
      people: {}
    }
  },

  methods: {
    getPeople() {
      PeopleApi.get(this.$route.params.id).then(this.setPeople)
    },

    setPeople(people) {
      this.people = people
      let education = EducationApi.get(people.education)
      this.people.education = education.name
    },

    makeActive() {
      EventBus.$emit('people-active', this.people);
    },
  },

  created() {
    this.getPeople()
    EventBus.$on('people-updated', this.setPeople);
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
