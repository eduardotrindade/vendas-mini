import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// Filters
import formatMoney   from './filters/money'
import formatDocumentNumber   from './filters/documentNumber'
import formatZipCode   from './filters/zipCode'
Vue.filter('formatMoney', formatMoney)
Vue.filter('formatDocumentNumber', formatDocumentNumber)
Vue.filter('formatZipCode', formatZipCode)

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
extend('required', required)
extend('max_value', max_value)
localize('pt_BR', pt_BR)
configure({ classes: {invalid: 'is-invalid'}, mode: 'lazy', useConstraintAttrs: false })
Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHome, faFile, faShoppingCart, faUsers, faEye } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon)
library.add(faHome, faFile, faShoppingCart, faUsers, faEye)

// Bootstrap Components
// It is necessary to import the components individually
// to decrease the bundle size, since bootstrap-vue is not "tree-shakable"
import { PaginationPlugin, DropdownPlugin } from 'bootstrap-vue'
[PaginationPlugin, DropdownPlugin].forEach(component => Vue.use(component))

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount('#app')
