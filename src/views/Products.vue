<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{ people.profile.name }}</h1>
      <p class="lead" v-if="isMaster">Somente máster na compra de lotes econômicos para revenda e pagamentos de espaços no programa semente digital.</p>
      <p class="lead" v-else>Todo afiliado receberá o crédito da compra no ID do respectivo Máster.</p>
    </div>
    <div class="container">
      <div class="card-deck mb-3 text-center">

        <div class="card mb-4 shadow-sm" v-for="(product, index) in products" :key="index">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ product.description }}</h4>
            <small class="text-muted">espaço assinatura anual</small>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">
              <span v-if="product.quantity">{{ product.price | formatMoney }}</span>
              <money v-else v-model.lazy="price" v-bind="money" class="form-control" placeholder="Digite o valor"></money>
              <small class="text-muted" v-if="product.quantity">/anual</small>
              <small class="text-muted" v-else>/parcela</small>
            </h1>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary" @click="buy(product)">Comprar</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Money } from 'v-money'
import ProfileApi from '@/api/profile'

export default {
  name: 'Products',
  components: { Money },
  computed: {
    ...mapGetters(['people']),
    isMaster() {
      return ProfileApi.MASTER == this.people.profile.id
    }
  },

  data() {
    return {
      products: {},
      price: 0.00,
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        suffix: '',
        precision: 2,
        masked: false
      }
    }
  },

  methods: {
    buy(product) {
      if (product.price == 0) {
        product.price = this.price
      }

      this.$store.dispatch('setProduct', product)
      this.$router.push({ name: `finalize-order` })
    }
  },

  created() {
    if (!this.people.id) {
      this.$router.push({ name: `home` })
    }

    ProfileApi.getProducts(this.people.profile.id)
      .then(products => {
        this.products = products
      }).catch(error => Promise.reject(error))
  },
}
</script>

<style scoped>
.pricing-card-title span,
.pricing-card-title small {
  display: block;
}
</style>
