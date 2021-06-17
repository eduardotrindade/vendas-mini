<template>
  <div class="container text-center pl-5 pr-5">
    <p class="h5 mt-3 mb-3">
      <strong>MINISITIO</strong> é uma nova ferramenta com uma plataform e um aplicativo de busca que
      pode ser baixado gratuitamente e que funciona como um Catálogo Digital com classificados de A a Z por cidade
    </p>
    <p class="h5 mb-3">
      Oportunidade de trabalho como <strong>AFILIADO</strong> autônomo.
      Renda Extra Imediata. Investimento <strong>ZERO</strong>.
    </p>
    <p class="h5 mb-3">
      <strong>Para saber mais informações, deixe seu WhatsApp:</strong>
    </p>

    <ValidationObserver class="mb-3" ref="$validator" tag="form" @submit.prevent="sendMoreInformation">
      <div class="form-row">
        <div class="col-auto">
          <img src="../assets/icons/whatsapp.png" alt="WhatsApp Icon" id="iconWhatsApp">
        </div>
        <div class="col-auto">
          <ValidationProvider rules="required" v-slot="{ classes }" name="numberWhatsApp" tag="div">
            <input type="text" class="form-control" :class="classes" placeholder="WhatsApp" id="numberWhatsApp" v-model.lazy="numberWhatsApp">
            <div class="invalid-feedback">{{ errorMessages.number }}</div>
          </ValidationProvider>
        </div>
        <div class="col-auto col-btn-enviar">
          <button class="btn btn-warning">Enviar</button>
        </div>
      </div>
    </ValidationObserver>

    <p class="h5 mb-3">
      São + de 20 milhões de <strong>EMPRESAS/INFORMAIS</strong>
      que precisam da sua ajuda com marketing digital.
    </p>
    <p class="h5 mb-3">
      1000 vagas <strong>EXCLUSIVAS</strong> nos Municípios.
    </p>
    <p class="h5 mb-3">
      Faça <strong>AGORA</strong> seu cadastro <strong>GRATUITO</strong>
    </p>
    <a
      class="btn btn-warning btn-lg"
      id="btnLinkSejaNossoRepresentante"
      href="https://vendas.minisitio.net/seja-nosso-representante/6WjJNfgLzwMg"
    >
      CLIQUE AQUI E MUDE SUA VIDA
    </a>
  </div>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import EventBus from '@/event-bus'
import PageApi from '@/api/page'

export default {
  name: "LangingPage",
  mixins: [ValidationMixin],

  data() {
    return {
      numberWhatsApp: null,
      errorMessages: {
        numberWhatsApp: 'Preenchimento  obrigatório.'
      }
    }
  },

  methods: {
    sendMoreInformation() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        PageApi.sendMoreInformation(this.numberWhatsApp).then(() => {
          EventBus.$emit(
            'alert-success',
            'Em breve entraremos em contato com mais informações!'
          );
          this.numberWhatsApp = null
          this.$refs.$validator.reset()
        }).catch(error => {
          let errors = error.data.errors
          this.setValidationErrors(errors)
          return Promise.reject(error)
        })
      })
    },
  },

  mounted() {
    let script = document.createElement('script')
    script.type = 'text/javascript'
    script.innerHTML = '(function(n,r,l,d){try{var h=r.head||r.getElementsByTagName("head")[0],s=r.createElement("script");s.setAttribute("type","text/javascript");s.setAttribute("src",l);n.neuroleadId=d;h.appendChild(s);}catch(e){}})(window,document,"https://cdn.leadster.com.br/neurolead/neurolead.min.js", 21908);'
    document.querySelector('body').appendChild(script)
  }
}
</script>

<style scoped>
  p {
    font-weight: normal !important;
  }
  form {
    display: flex;
    justify-content: center;
  }
  #btnLinkSejaNossoRepresentante {
    max-width: 200px;
  }
  #iconWhatsApp {
    height: 32px;
  }
  @media (min-width: 768px) {
    h1 {
      font-size: 2.0rem;
    }
  }
  @media (max-width: 576px) {
    h1 {
      font-size: 1.5rem;
      margin-top: 1.5rem !important;
      margin-bottom: 1.5rem !important;
    }
    p {
      font-size: 1rem;
    }
    .col-btn-enviar {
      display: block;
      width: 100%;
      margin-top: 10px;
    }
  }
</style>
