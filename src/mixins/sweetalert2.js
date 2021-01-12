import Vue from 'vue'
import EventBus from '@/event-bus'

export default {
  methods: {
    showAlert(options = {}) {
      options = Object.assign({}, options)
      Vue.swal(options)
    },

    showAlertError(message, extraMessages = []) {
      this.showAlert({
        title: 'Erro!',
        icon: 'error',
        html: this._createVNodes(message, extraMessages)
      })
    },

    showAlertSuccess(message) {
      this.showAlert({
        title: 'Sucesso!',
        icon: 'success',
        html: this._createVNodes(message),
      })
    },

    showAlertWarning(message) {
      this.showAlert({
        title: 'Atenção!',
        icon: 'warning',
        html: this._createVNodes(message),
      })
    },

    _createVNodes(message, extraMessages = []) {
      let messageNode = `<span>${message}</span>`, ul

      if (extraMessages.length) {
        let li = extraMessages.map(e => `<li>${e}</span>`)
        ul = `<ul>${li}</ul>`
      }

      return messageNode + ul
    }
  },

  created() {
    EventBus.$on('alert-error', this.showAlertError)
    EventBus.$on('alert-success', this.showAlertSuccess)
    EventBus.$on('alert-warning', this.showAlertWarning)
  }
}
