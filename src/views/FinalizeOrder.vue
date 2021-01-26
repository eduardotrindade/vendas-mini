<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Finalizar Compra</h1>
      <p class="lead">Quando for reconhecido o pagamento, os créditos seram creditados no respectivo ID.</p>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Produtos</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{ product.description }}</h6>
                <small class="text-muted">Compra de espaço assinatura anual</small>
              </div>
              <span class="text-muted">{{ product.price | formatMoney }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>{{ product.price | formatMoney }}</strong>
            </li>
          </ul>

          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">
              <span>Indicado por:</span>
              <h6 class="my-0">{{ people.indicated_by }}</h6>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Comprador</h4>
          <form class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nome</label>
                <p>{{ people.name }}</p>
              </div>

              <div class="col-md-6 mb-3">
                <label>E-mail</label>
                <p>{{ people.email }}</p>
              </div>
            </div>

            <div class="mb-3">
              <label>Endereço</label>
              <p>
                {{ people.address }} Nº {{ people.number }}
                <span v-if="people.complement">{{ people.complement }}</span>
                <span v-if="people.neighborhood"> - {{ people.neighborhood }}</span>
              </p>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label>Cidade</label>
                <p>{{ people.city.name }}</p>
              </div>
              <div class="col-md-4 mb-3">
                <label>Estado</label>
                <p>{{ people.city.state.name }}</p>
              </div>
              <div class="col-md-3 mb-3">
                <label>CEP</label>
                <p>{{ people.zip_code }}</p>
              </div>
            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="button" @click="finalize()">Realizar pagamento</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import EventBus from '@/event-bus'
import OrderApi from '@/api/order'

export default {
  name: 'FinalizeOrder',
  computed: {
    ...mapGetters(['people', 'product']),
  },

  data() {
    return {}
  },

  methods: {
    finalize() {
      const order = {
        people_id: this.people.id,
        product_id: this.product.id,
        amount_paid: this.product.price,
      }

      OrderApi.insert(order)
        .then(() => {
          EventBus.$emit('alert-success', 'Parabéns!!! Compra finalizada com sucesso.')
          this.$store.dispatch('setPeople', {})
          this.$router.push({ name: `home` })
        }).catch(error => Promise.reject(error))
    },
  },

  created() {
    if (!this.people.id || !this.product.id) {
      this.$router.push({ name: `home` })
    }
  },
}
</script>
