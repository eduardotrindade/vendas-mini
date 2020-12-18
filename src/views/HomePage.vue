<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Compra de espaços</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <div class="container">
      <form class="form-signin">
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Informe seu CPF/CNPJ</h1>
        </div>
        <div class="form-label-group mb-3">
          <the-mask :mask="['###.###.###-##', '##.###.###/####-##']" class="form-control" autocomplete="off" placeholder="000.000.000-00 ou 00.000.000/0000-00" id="cpf_cnpj" name="cpf_cnpj" v-model="cpf_cnpj" />
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="button" @click="continuar()">Continuar</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomePage",

  data() {
    return {
      cpf_cnpj: null
    }
  },

  methods: {
    continuar() {
      if(!this.cpf_cnpj) return false
      console.log(this.cpf_cnpj)
      const proximo = this.cpf_cnpj.length > 11 ? 'master' : 'afiliado'
      this.$router.push({ name: `venda-${proximo}` })
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
