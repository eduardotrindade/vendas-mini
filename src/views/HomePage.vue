<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Compra de espaços</h1>
      <p class="lead">
        Assinaturas anuais de espaços minisitios, solução moderna de comunicação
        e informação correta para todos
      </p>
    </div>
    <div class="container">
      <ValidationObserver ref="$validator" tag="form" class="form-signin" @submit.prevent="verifyDocumentNumber">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Informe seu CPF/CNPJ</h1>
        </div>
        <ValidationProvider rules="required" v-slot="{ classes }" name="numero" tag="div" class="form-label-group mb-3">
          <the-mask
            autocomplete="off"
            placeholder="000.000.000-00 ou 00.000.000/0000-00"
            :mask="['###.###.###-##', '##.###.###/####-##']"
            class="form-control"
            :class="classes"
            id="document_number"
            name="document_number"
            v-model="document_number"
          />
          <div class="invalid-feedback">{{ errorMessages.document_number }}</div>
        </ValidationProvider>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Continuar</button>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import PeopleApi from '@/api/people'

export default {
  name: "HomePage",
  mixins: [ValidationMixin],

  data() {
    return {
      document_number: null,
      errorMessages: {
        document_number: 'Imforme o CPF/CNPJ para continuar.'
      }
    }
  },

  methods: {
    verifyDocumentNumber() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        PeopleApi.getByDocumentNumber(this.document_number)
          .then(people => {
            this.$store.dispatch('setPeople', people)
            this.$router.push({ name: 'products' })
          }).catch(() => { })
      })
    }
  }
}
</script>

<style scoped>
.form-signin {
  width: 100%;
  max-width: 420px;
  padding: 15px;
  margin: auto;
}
</style>
