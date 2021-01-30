<template>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-1">
      <font-awesome-icon :icon="message.icon" :class="message.class" />
    </h1>
    <h2>{{ message.text }}</h2>
  </div>
</template>

<script>
const messages = {
  success: {
    icon: 'check-circle',
    class: 'text-success',
    text: 'Pagamento realizado com sucesso, em breve os créditos seram creditados no respectivo ID.'
  },
  pending: {
    icon: 'exclamation-circle',
    class: 'text-warning',
    text: 'Quando for reconhecido o pagamento, os créditos seram creditados no respectivo ID.'
  },
  failure: {
    icon: 'times-circle',
    class: 'text-danger',
    text: 'Erro ao realizar o pagamento, verifique o problema ou tente novamente.'
  }
}

export default {
  name: 'PaymentFeedback',

  data() {
    return {
      message: {}
    }
  },

  methods: {
    setPaymentStatus() {
      switch (this.$route.query.status) {
        case 'approved':
        case 'authorized':
          this.message = messages.success
          break;
        case 'pending':
        case 'in_process':
          this.message = messages.pending
          break;
        default:
          this.message = messages.failure
          break;
      }
    },
  },

  created() {
    this.setPaymentStatus()
  }
}
</script>
