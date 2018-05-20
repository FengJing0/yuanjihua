// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import store from './store'
import VueLazyLoad from 'vue-lazyload'
import VueQuillEditor from 'vue-quill-editor'
import 'element-ui/lib/theme-chalk/index.css'
import Axios from 'axios'

Vue.config.productionTip = false
// Axios.defaults.baseURL = 'http://127.0.0.1'

Vue.prototype.$axios = Axios;
Vue.use(ElementUI)
Vue.use(VueQuillEditor)
Vue.use(VueLazyLoad, {
  loading: require('./common/imgs/loading.gif'),
  error: require('./common/imgs/error.gif')
})
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  // components: { App },
  // template: '<App/>'
  render: h => h(App)
})
