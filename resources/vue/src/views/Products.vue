<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-3">
          <img v-if="isMaster" src="../assets/img/promo-masters.jpeg" alt="Promo Masters" class="img-fluid mt-5 mb-5">
        </div>
        <div class="col-6">
          <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">{{ people.profile.name }}</h1>
            <p class="lead" v-if="isMaster">Somente máster na compra de lotes econômicos para revenda e pagamentos de espaços no programa semente digital.</p>
            <p class="lead" v-else>Todo afiliado receberá o crédito da compra no ID do respectivo Máster.</p>
          </div>
        </div>
        <div class="col-3">
          <a v-if="isMaster" href="https://drive.google.com/drive/folders/1XK_zclJo0_2QjZ0ifEXFWJXgeCY9WhEr?usp=share_link" target="_blank" title="Acesse o conteúdo">
            <img src="../assets/img/link-masters.jpeg" alt="Link Masters" class="img-fluid mt-5 mb-5">
          </a>
        </div>
      </div>

      <div class="card-deck mb-3 text-center">

        <div class="card mb-4 shadow-sm" v-for="(product, index) in products" :key="index">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ product.description }}</h4>
            <small class="text-muted">espaço assinatura anual</small>
          </div>
          <div class="card-body">
            <h2 class="card-title pricing-card-title">
              <span v-if="product.quantity">{{ product.price | formatMoney }}</span>
              <money v-else v-model.lazy="price" v-bind="money" class="form-control" placeholder="Digite o valor"></money>
              <small class="text-muted" v-if="product.quantity">/anual</small>
              <small class="text-muted" v-else>/parcela</small>
            </h2>
            <button
              type="button"
              class="btn btn-lg btn-block btn-outline-primary"
              :id="`btnComprar${product.id}`"
              @click="buy(product)"
            >
              <span v-if="product.quantity">Comprar</span>
              <span v-else>Pagar</span>
            </button>
          </div>
        </div>

      </div>
    </div>

    <order-information-modal/>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Money } from 'v-money'
import ProfileApi from '@/api/profile'
import EventBus from '@/event-bus'
import OrderInformationModal from '@/views/OrderInformationModal'

export default {
  name: 'Products',
  components: { Money, OrderInformationModal },

  computed: {
    ...mapGetters(['people']),
    isMaster() {
      return ProfileApi.MASTER == this.people.profile.id
    }
  },

  data() {
    return {
      products: {},
      product: {},
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
      if (product.price === 0) {
        product.price = this.price
      }

      if (!product.price) {
        EventBus.$emit('alert-error', 'Deve ser um valor diferente que zero.')
        return
      }

      this.product = product;

      if (this.product.quantity) {
        this.product.orderInformation = null
        this.finalizeBuy(product)
        return
      }

      EventBus.$emit('order-information-modal-show')
    },

    finalizeBuy(product) {
      this.$store.dispatch('setProduct', product)
      this.$router.push({ name: `finalize-order` })
    },

    setOrderInformation(information) {
      this.product.orderInformation = information
      this.finalizeBuy(this.product)
    },
  },

  created() {
    if (!this.people.id) {
      this.$router.push({ name: `home` })
    }

    ProfileApi.getProducts(this.people.profile.id)
      .then(products => {
        this.products = products
      }).catch(error => Promise.reject(error))

    EventBus.$on('order-set-information', this.setOrderInformation)
  },

  mounted() {
    let script = document.createElement('script')
    script.src = 'https://www.mercadopago.com/v2/security.js'
    script.type = 'text/javascript'
    script.setAttribute('view', 'search')
    document.querySelector('body').appendChild(script)
  }
}
</script>

<style scoped>
.pricing-header {
  max-width: 700px;
}

.pricing-card-title span,
.pricing-card-title small {
  display: block;
}

.card-deck .card {
  min-width: 220px;
}

@media (min-width: 576px) {
  .card-deck {
    justify-content: center;
  }

  .card-deck .card {
    max-width: 247.5px;
  }
}
</style>
