<template>
  <div>
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>Novo Diretor</h2>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 px-5">
        <ValidationObserver ref="$validator" tag="form" @submit.prevent="registrationPeople">
          <div class="row">
            <h4 class="col-md-12 mb-3">Dados Pessoais</h4>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name">Nome</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="name" tag="div">
                  <input type="text" class="form-control" :class="classes" id="name" v-model.lazy="people.name">
                  <div class="invalid-feedback">{{ errorMessages.name }}</div>
                </ValidationProvider>
              </div>

              <div class="mb-3">
                <label for="document_number">CPF/CNPJ</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="document_number" tag="div">
                  <the-mask :mask="['###.###.###-##', '##.###.###/####-##']" class="form-control" :class="classes" id="document_number" v-model.lazy="people.document_number" />
                  <div class="invalid-feedback">{{ errorMessages.document_number }}</div>
                </ValidationProvider>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="cellphone">Celular <span class="text-muted">(com WhatsApp)</span></label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="cellphone" tag="div">
                  <the-mask :mask="['(##) ####-####', '(##) #####-####']" class="form-control" :class="classes" id="cellphone" v-model.lazy="people.cellphone" />
                  <div class="invalid-feedback">{{ errorMessages.cellphone }}</div>
                </ValidationProvider>
              </div>

              <div class="mb-3">
                <label for="email">E-mail</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="email" tag="div">
                  <input type="email" class="form-control" :class="classes" id="email" v-model.lazy="people.email">
                  <div class="invalid-feedback">{{ errorMessages.email }}</div>
                </ValidationProvider>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <h4 class="col-md-12 mb-3">Dados de Endereço</h4>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="address">Logradouro</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="address" tag="div">
                  <input type="text" class="form-control" :class="classes" id="address" v-model.lazy="people.address">
                  <div class="invalid-feedback">{{ errorMessages.address }}</div>
                </ValidationProvider>
              </div>

              <div class="mb-3">
                <label for="number">Número</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="number" tag="div">
                  <input type="text" class="form-control" :class="classes" id="number" v-model.lazy="people.number">
                  <div class="invalid-feedback">{{ errorMessages.number }}</div>
                </ValidationProvider>
              </div>

              <div class="mb-3">
                <label for="complement">Complemento <span class="text-muted">(opcional)</span></label>
                <input type="text" class="form-control" id="complement" v-model.lazy="people.complement">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="neighborhood">Bairro <span class="text-muted">(opcional)</span></label>
                <input type="text" class="form-control" id="neighborhood" v-model.lazy="people.neighborhood">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="state_id">Estado</label>
                  <ValidationProvider rules="required" v-slot="{ classes }" name="state_id" tag="div">
                    <select class="custom-select d-block w-100" :class="classes" id="state_id" v-model.lazy="people.state_id" @change="getCities">
                      <option value="">Selecione</option>
                      <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errorMessages.state_id }}</div>
                  </ValidationProvider>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="city">Cidade</label>
                  <ValidationProvider rules="required" v-slot="{ classes }" name="city" tag="div">
                    <select class="custom-select d-block w-100" :class="classes" id="city" v-model.lazy="people.city_id">
                      <option value="">Selecione</option>
                      <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errorMessages.city_id }}</div>
                  </ValidationProvider>
                </div>
              </div>

              <div class="mb-3">
                <label for="zip_code">CEP</label>
                <ValidationProvider rules="required" v-slot="{ classes }" name="zip_code" tag="div">
                  <the-mask :mask="['##.###-###']" class="form-control" :class="classes" id="zip_code" v-model.lazy="people.zip_code" />
                  <div class="invalid-feedback">{{ errorMessages.zip_code }}</div>
                </ValidationProvider>
              </div>
            </div>
          </div>

          <hr class="mb-4">

          <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import {mask} from 'vue-the-mask'
import ValidationMixin from '@/mixins/validation'
import EventBus from '@/event-bus'
import StateApi from '@/api/state'
import ProfileApi from '@/api/profile'
import PeopleApi from '@/api/people'

export default {
  name: 'PeopleView',
  directives: {mask},
  mixins: [ValidationMixin],

  data() {
    const requiredMessage = 'Preenchimento  obrigatório.'

    return {
      people: {
        profile_id: ProfileApi.DIRETOR,
        resume: 'Diretor',
        terms_accepted: true
      },
      states: {},
      cities: {},
      errorMessages: {
        name: requiredMessage,
        document_number: requiredMessage,
        cellphone: requiredMessage,
        email: requiredMessage,
        address: requiredMessage,
        number: requiredMessage,
        neighborhood: requiredMessage,
        state: requiredMessage,
        state_id: requiredMessage,
        city_id: requiredMessage,
        zip_code: requiredMessage,
      },
    }
  },

  methods: {
    getPeople() {
      if (!this.$route.params.id) {
        return;
      }
      PeopleApi.get(this.$route.params.id).then(this.setPeople)
    },

    getStates() {
      StateApi.getAll().then(states => {
        this.states = states
      }).catch(error => {
        let errors = error.data.errors
        this.setValidationErrors(errors)
        return Promise.reject(error)
      })
    },

    getCities() {
      StateApi.getCities(this.people.state_id).then(cities => {
        this.cities = cities
      }).catch(error => {
        let errors = error.data.errors
        this.setValidationErrors(errors)
        return Promise.reject(error)
      })
    },

    setPeople(people) {
      this.people = people
    },

    registrationPeople() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        PeopleApi.save(this.people).then(() => {
          EventBus.$emit(
            'alert-success',
            'Solicitação realizada com sucesso!! <br>' +
            'Em breve entraremos em contato sobre a analise do seu cadastro.'
          );
          this.$route.push({ name: 'people-list' })
        }).catch(error => {
          let errors = error.data.errors
          this.setValidationErrors(errors)
          return Promise.reject(error)
        })
      })
    },
  },

  created() {
    this.getStates()
    this.getPeople()
  },

  watch: {
    '$route' () {
      this.getStates()
      this.getPeople()
    }
  }
}
</script>

<style scoped>
.form-check-label {
  color: #212529 !important;
}
</style>
