import Vue from 'vue'
import Router from 'vue-router'
import Login from '../components/users/Login.vue'
import Index from '../components//users/Index.vue'
import Usercenter from '../components/users/Usercenter.vue'
import Topic from '../components/users/Topic.vue'
import Clubcreate from '../components/users/Clubcreate.vue'
import Actionmore from '../components/users/Actionmore.vue'
import Clubdetail from '../components/users/Clubdetail.vue'
import Joinclub from '../components/users/Joinclub.vue'

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
      path: '/Joinclub',
      name: 'Joinclub',
      component: Joinclub
    },
    {
      path: '/Usercenter',
      name: 'Usercenter',
      component: Usercenter
    },
    {
      path: '/Clubdetail',
      name: 'Clubdetail',
      component: Clubdetail
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
    },
    {
      path:'/Actionmore',
      name:'Actionmore',
      component: Actionmore
    }
  ]
})

export default router
