<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Afiliado</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <div class="container">
      <div class="card-deck mb-3 text-center">

        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">1 unidade</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">R$ 90,00 <small class="text-muted">/ anual</small></h1>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary" @click="comprar()">Comprar</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">3 unidades</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">R$ 240,00 <small class="text-muted">/ anual</small></h1>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary" @click="comprar()">Comprar</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">10 unidades</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">R$ 700,00 <small class="text-muted">/ anual</small></h1>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary" @click="comprar()">Comprar</button>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">20 unidade</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">R$ 1.200,00 <small class="text-muted">/ anual</small></h1>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary" @click="comprar()">Comprar</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'VendaAfiliado',

  data() {
    return {}
  },

  methods: {
    comprar() {
      this.$router.push({ name: `venda-finalizar` })
    }
  }
}
</script>
