<template>
  <b-modal
    id="people-active-modal"
    title="Ativar Representante"
    size="md"
    @ok.prevent="makeActive"
    ok-title="Salvar"
    cancel-title="Cancelar"
  >
    <ValidationObserver ref="$validator" tag="div" class="row">
      <div class="form-group col-12">
        <label for="profile_id">Perfil:</label>
        <ValidationProvider rules="required" v-slot="{ classes }" name="profile_id" tag="div">
          <select id="profile_id" class="form-control" :class="classes" v-model.lazy="profileId">
            <option :value="masterId">Master</option>
            <option :value="afiliadoId">Afiliado</option>
          </select>
          <div class="invalid-feedback">{{ errorMessages.profile_id }}</div>
        </ValidationProvider>
      </div>
    </ValidationObserver>
  </b-modal>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import EventBus from '@/event-bus'
import ProfileApi from '@/api/profile'
import PeopleApi from '@/api/people'

export default {
  name: "PeopleActive",
  mixins: [ValidationMixin],

  data() {
    return {
      masterId: ProfileApi.MASTER,
      afiliadoId: ProfileApi.AFILIADO,
      peopleId: null,
      profileId: null,
      errorMessages: {
        profile_id: 'Selecione o perfil'
      }
    }
  },

  methods: {
    showModal(peopleId) {
      this.peopleId = peopleId
      this.$root.$emit('bv::show::modal','people-active-modal')
    },

    makeActive() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        PeopleApi.makeActive(this.peopleId, this.profileId)
          .then(people => {
            EventBus.$emit('alert-success', 'Representante ativado com sucesso!')
            EventBus.$emit('people-updated', people)
            this.$root.$emit('bv::hide::modal','people-active-modal')
          }).catch(error => {
            let errors = error.data.errors
            this.setValidationErrors(errors)
            return Promise.reject(error)
          })
      })
    }
  },

  created() {
    EventBus.$on('people-active', this.showModal)
  }
}
</script>

<style scoped>

</style>
