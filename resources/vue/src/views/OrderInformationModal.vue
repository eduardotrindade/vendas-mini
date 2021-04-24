<template>
  <b-modal
    id="order-information-modal"
    title="Informe o contrato e o número da parcela"
    size="md"
    @ok.prevent="submit"
    ok-title="Continuar"
    cancel-title="Cancelar"
  >
    <ValidationObserver ref="$validator" tag="div" class="row">
      <div class="form-group col-12">
        <ValidationProvider rules="required" v-slot="{ classes }" name="information" tag="div">
          <input id="information" class="form-control" :class="classes" v-model.lazy="information">
          <div class="invalid-feedback">{{ errorMessages.information }}</div>
        </ValidationProvider>
      </div>
    </ValidationObserver>
  </b-modal>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import EventBus from '@/event-bus'

export default {
  name: "OrderInformationModal",
  mixins: [ValidationMixin],

  data() {
    return {
      information: null,
      errorMessages: {
        information: 'Informe o contrato e o número da parcela'
      }
    }
  },

  methods: {
    showModal() {
      this.$root.$emit('bv::show::modal','order-information-modal')
    },

    submit() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        EventBus.$emit('order-set-information', this.information)
        this.$root.$emit('bv::hide::modal','order-information-modal')
      })
    }
  },

  created() {
    EventBus.$on('order-information-modal-show', this.showModal)
  }
}
</script>
