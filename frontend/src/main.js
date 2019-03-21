// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import '../src/assets/css/reset.css'
import common from './assets/js/common.js'
import VueResource from 'vue-resource'

Vue.config.productionTip = false
Vue.use(ElementUI)
Vue.use(VueResource)

// 设置全局公用方法
Vue.prototype.common = common;

// 设置全局请求头
Vue.http.headers.common['authkey'] = sessionStorage.getItem('authKey')
Vue.http.headers.common['sessionid'] = sessionStorage.getItem('sessionId')

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
