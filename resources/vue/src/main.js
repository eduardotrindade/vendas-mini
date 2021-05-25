import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// Filters
import formatDate from './filters/date'
import formatMoney from './filters/money'
import formatDocumentNumber from './filters/documentNumber'
import formatZipCode from './filters/zipCode'
import formatPhone from './filters/phone'
Vue.filter('formatDate', formatDate)
Vue.filter('formatMoney', formatMoney)
Vue.filter('formatDocumentNumber', formatDocumentNumber)
Vue.filter('formatZipCode', formatZipCode)
Vue.filter('formatPhone', formatPhone)

// Clipboard
import Clipboard from 'v-clipboard'
Vue.use(Clipboard)

// Mask
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

// VueSweetalert2
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
Vue.use(VueSweetalert2)

// Form Validations
import { ValidationObserver, ValidationProvider, configure, extend, localize } from 'vee-validate'
import { required, max_value } from 'vee-validate/dist/rules'
import pt_BR from 'vee-validate/dist/locale/pt_BR'
import { cpf, cnpj } from 'cpf-cnpj-validator'
extend('required', required)
extend('max_value', max_value)
extend('cpf_cnpj', {
  validate: (value) => {
    if (value.length <= 11) {
      return cpf.isValid(value)
    } else {
      return cnpj.isValid(value)
    }
  },
  message: 'O campo {_field_} deve ter um valor válido'
})
localize('pt_BR', pt_BR)
configure({ classes: {invalid: 'is-invalid'}, mode: 'lazy', useConstraintAttrs: false })
Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHome, faFile, faShoppingCart, faUsers, faEye, faPowerOff, faUserCircle, faCheckCircle, faTimesCircle, faExclamationCircle, faFileInvoice, faCopy } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon)
library.add(faHome, faFile, faShoppingCart, faUsers, faEye, faPowerOff, faUserCircle, faCheckCircle, faTimesCircle, faExclamationCircle, faFileInvoice, faCopy)

// Bootstrap Components
// It is necessary to import the components individually
// to decrease the bundle size, since bootstrap-vue is not "tree-shakable"
import { PaginationPlugin, ModalPlugin, CollapsePlugin } from 'bootstrap-vue'
[PaginationPlugin, ModalPlugin, CollapsePlugin].forEach(component => Vue.use(component))

// Google Tag Manager
import VueGtm from '@gtm-support/vue2-gtm'
Vue.use(VueGtm, {
  id: 'GTM-KQ8CV5J',
  defer: false, // defaults to false. Script can be set to `defer` to increase page-load-time at the cost of less accurate results (in case visitor leaves before script is loaded, which is unlikely but possible)
  enabled: true, // defaults to true. Plugin can be disabled by setting this to false for Ex: enabled: !!GDPR_Cookie (optional)
  debug: true, // Whether or not display console logs debugs (optional)
  loadScript: true, // Whether or not to load the GTM Script (Helpful if you are including GTM manually, but need the dataLayer functionality in your components) (optional)
  vueRouter: router, // Pass the router instance to automatically sync with router (optional)
  ignoredViews: [], // Don't trigger events for specified router names (case insensitive) (optional)
  trackOnNextTick: false // Whether or not call trackView in Vue.nextTick
})

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount('#app')
