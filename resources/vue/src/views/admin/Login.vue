<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Área Administrativa</h1>
    </div>
    <div class="container">
      <ValidationObserver ref="$validator" tag="form" class="form-signin" @submit.prevent="submit">

        <ValidationProvider rules="required" v-slot="{ classes }" name="email" tag="div" class="mb-3">
          <input type="email" id="email" name="email" placeholder="E-mail" class="form-control" :class="classes" v-model.lazy="user.email" />
          <div class="invalid-feedback">Deve informar o e-mail</div>
        </ValidationProvider>

        <ValidationProvider rules="required" v-slot="{ classes }" name="password" tag="div" class="mb-3">
          <input type="password" id="password" name="password" placeholder="Senha" class="form-control" :class="classes" v-model.lazy="user.password" />
          <div class="invalid-feedback">Deve informar a senha</div>
        </ValidationProvider>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

        <div class="text-center mt-3">
          <a href="#" @click.prevent="showForgotPassword = true" class="text-muted">Esqueci minha senha</a>
        </div>
      </ValidationObserver>

      <div v-if="showForgotPassword" class="mt-4">
        <h5 class="text-center">Recuperar Senha</h5>
        <ValidationObserver ref="$validatorForgot" tag="form" @submit.prevent="forgotPassword">
          <ValidationProvider rules="required|email" v-slot="{ classes }" name="email" tag="div" class="mb-3">
            <input type="email" id="emailForgot" name="email" placeholder="Seu e-mail" class="form-control" :class="classes" v-model.lazy="forgotEmail" />
            <div class="invalid-feedback">Informe seu e-mail</div>
          </ValidationProvider>

          <button class="btn btn-lg btn-warning btn-block" type="submit" :disabled="loadingForgot">
            {{ loadingForgot ? 'Enviando...' : 'Enviar Link de Recuperação' }}
          </button>
          <div class="text-center mt-3">
            <a href="#" @click.prevent="showForgotPassword = false" class="text-muted">Voltar ao login</a>
          </div>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import ValidationMixin from '@/mixins/validation'
import AuthApi from '@/api/auth'
import EventBus from '@/event-bus'

export default {
  name: 'Login',
  mixins: [ValidationMixin],

  data() {
    return {
      user: {},
      showForgotPassword: false,
      forgotEmail: '',
      loadingForgot: false
    }
  },

  methods: {
    ...mapActions(['login']),

    submit() {
      return this.$refs.$validator.validate().then(async isValid => {
        if (!isValid) return Promise.reject()

        await this.login(this.user)
        this.$router.push({ name: 'orders-list' })
      })
    },

    forgotPassword() {
      return this.$refs.$validatorForgot.validate().then(async isValid => {
        if (!isValid) return Promise.reject()

        this.loadingForgot = true
        AuthApi.forgotPassword(this.forgotEmail).then(response => {
          EventBus.$emit('alert-success', response.message)
          this.showForgotPassword = false
          this.forgotEmail = ''
        }).finally(() => {
          this.loadingForgot = false
        })
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
