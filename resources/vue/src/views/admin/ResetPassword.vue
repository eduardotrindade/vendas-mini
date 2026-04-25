<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Nova Senha</h1>
    </div>
    <div class="container">
      <ValidationObserver ref="$validator" tag="form" class="form-signin" @submit.prevent="submit">
        
        <p class="text-center text-muted mb-4">Digite sua nova senha abaixo.</p>

        <ValidationProvider rules="required|email" v-slot="{ classes }" name="email" tag="div" class="mb-3">
          <input type="email" id="email" name="email" placeholder="Seu e-mail" class="form-control" :class="classes" v-model.lazy="data.email" />
          <div class="invalid-feedback">Informe seu e-mail</div>
        </ValidationProvider>

        <ValidationProvider rules="required|min:6" v-slot="{ classes }" name="password" tag="div" class="mb-3" wid="password">
          <input type="password" id="password" name="password" placeholder="Nova Senha" class="form-control" :class="classes" v-model.lazy="data.password" />
          <div class="invalid-feedback">A senha deve ter no mínimo 6 caracteres</div>
        </ValidationProvider>

        <ValidationProvider rules="required|confirmed:password" v-slot="{ classes }" name="password_confirmation" tag="div" class="mb-3">
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Nova Senha" class="form-control" :class="classes" v-model.lazy="data.password_confirmation" />
          <div class="invalid-feedback">As senhas não coincidem</div>
        </ValidationProvider>

        <button class="btn btn-lg btn-primary btn-block" type="submit" :disabled="loading">
          {{ loading ? 'Processando...' : 'Alterar Senha' }}
        </button>

        <div class="text-center mt-3">
          <router-link :to="{ name: 'login' }" class="text-muted">Voltar ao login</router-link>
        </div>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import AuthApi from '@/api/auth'
import EventBus from '@/event-bus'

export default {
  name: 'ResetPassword',
  mixins: [ValidationMixin],

  data() {
    return {
      data: {
        token: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      loading: false
    }
  },

  methods: {
    submit() {
      return this.$refs.$validator.validate().then(async isValid => {
        if (!isValid) return Promise.reject()

        this.loading = true
        AuthApi.resetPassword(this.data).then(response => {
          EventBus.$emit('alert-success', response.message)
          this.$router.push({ name: 'login' })
        }).finally(() => {
          this.loading = false
        })
      })
    }
  },

  created() {
    this.data.token = this.$route.params.token
    this.data.email = this.$route.query.email || ''
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
