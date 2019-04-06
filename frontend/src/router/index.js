import Vue from 'vue'
import Router from 'vue-router'
import Login from '../components/users/Login.vue'
import Index from '../components//users/Index.vue'
import Usercenter from '../components/users/Usercenter.vue'
import Topic from '../components/users/Topic.vue'
import Clubcreate from '../components/users/Clubcreate.vue'

Vue.use(Router)

const router = new Router({
  mode:'history',
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    },
    {
      path: '/Usercenter',
      name: 'Usercenter',
      component: Usercenter
    },
    {
      path: '/Topic',
      name: 'Topic',
      component: Topic
    },
    {
      path:'/Clubcreate',
      name:'Clubcreate',
      component: Clubcreate
    }
  ]
})

export default router
