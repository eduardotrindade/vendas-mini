export default {
  methods: {
    showAlert(vNodes, options = {}) {
      options = Object.assign({ solid: true }, options);
      this.$bvToast.toast(vNodes, options);
    },

    showAlertError(message, extraMessages = []) {
      this.showAlert(this._createVNodes(message, extraMessages), {
        noAutoHide : true,
        title      : 'Erro!',
        variant    : 'danger'
      });
    },

    showAlertSuccess(message) {
      this.showAlert(this._createVNodes(message), {
        title   : 'Sucesso!',
        variant : 'success'
      });
    },

    showAlertWarning(message) {
      this.showAlert(this._createVNodes(message), {
        title   : 'Atenção!',
        variant : 'warning'
      });
    },

    _createVNodes(message, extraMessages = []) {
      let messageNode       = this.$createElement('span', message),
        extraMessagesNode = extraMessages.length
          ? this.$createElement('ul', extraMessages.map(e => this.$createElement('li', e)))
          : [];

      return Array.prototype.concat(messageNode, extraMessagesNode);
    }
  },

  created() {
    this.$root.$on('alert-error', this.showAlertError);
    this.$root.$on('alert-success', this.showAlertSuccess);
    this.$root.$on('alert-warning', this.showAlertWarning);
  }
}
