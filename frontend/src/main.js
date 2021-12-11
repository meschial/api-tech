import Vue from 'vue'
import App from './App.vue'
import router from './router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Toast from 'vue-toastification'
import JwPagination from 'jw-vue-pagination'

import 'vue-toastification/dist/index.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const DEFAULT_TITLE = 'Api Tech'
router.afterEach((to, from) => {
  document.title = to.meta.title || DEFAULT_TITLE
})

Vue.use(require('vue-moment'))
Vue.component('jw-pagination', JwPagination)
Vue.use(Toast)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
