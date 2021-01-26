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
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import ValidationMixin from '@/mixins/validation'

export default {
  name: 'Login',
  mixins: [ValidationMixin],

  data() {
    return {
      user: {}
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
