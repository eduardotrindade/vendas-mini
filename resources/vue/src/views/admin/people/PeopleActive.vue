<template>
  <b-modal
    id="people-active-modal"
    title="Deseja alterar o status?"
    size="md"
    @ok.prevent="submit"
    ok-title="Sim"
    cancel-title="Não"
  >
    <ValidationObserver ref="$validator" tag="div" class="row">
      <div class="form-group col-12" v-if="isProfile">
        <label for="profile_id">Perfil:</label>
        <ValidationProvider rules="required" v-slot="{ classes }" name="profile_id" tag="div">
          <select id="profile_id" class="form-control" :class="classes" v-model.lazy="profileId">
            <option
              v-for="profile in profiles"
              :key="profile.id"
              :value="profile.id"
            >
              {{ profile.name }}
            </option>
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
      profiles: [
        {
          id: ProfileApi.MASTER,
          name: 'Master'
        },
        {
          id: ProfileApi.AFILIADO,
          name: 'Afiliado'
        }
      ],
      people: {
        id: null,
        profile: null
      },
      profileId: null,
      errorMessages: {
        profile_id: 'Selecione o perfil'
      }
    }
  },

  computed: {
    isProfile() {
      return !this.people.profile
    }
  },

  methods: {
    showModal(people) {
      this.people = people
      this.$root.$emit('bv::show::modal','people-active-modal')
    },

    submit() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        PeopleApi.changeActive(this.people.id, this.profileId)
          .then(people => {
            EventBus.$emit('alert-success', 'Representante atualizado com sucesso!')
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
