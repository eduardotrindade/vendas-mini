<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{ this.people.profile.name }}</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <div class="container">
      <div class="card-deck mb-3 text-center">

        <div class="card mb-4 shadow-sm" v-for="(product, index) in products" :key="index">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal" v-if="product.quantity">{{ product.quantity }} {{ product.description }}</h4>
            <h4 class="my-0 font-weight-normal" v-else>{{ product.description }}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">
              <span v-if="product.quantity">{{ product.price | formatMoney }}</span>
              <input v-else type="text" class="form-control" placeholder="Digite o valor" autocomplete="off" name="valor">
              <small class="text-muted" v-if="product.quantity">/lote</small>
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
import ValidationMixin from '@/mixins/validation'
import ProfileApi from '@/api/profile'

export default {
  name: 'Products',
  mixins: [ValidationMixin],
  computed: {
    ...mapGetters(['people']),
  },

  data() {
    return {
      products: {},
    }
  },

  methods: {
    buy(product) {
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
      }).catch(error => {
        let errors = error.data.errors
        this.setValidationErrors(errors)
        return Promise.reject(error)
      })
  },
}
</script>

<style scoped>
.pricing-card-title span,
.pricing-card-title small {
  display: block;
}
</style>
