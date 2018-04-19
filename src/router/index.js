import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/index/index'
import Knowledge from '@/components/knowledge/knowledge'
import Activity from '@/components/activity/activity'
import Articles from '@/components/articles/articles'
import Write from '@/components//articles/write'
import User from '@/components/user/user'
import Login from '@/components/login/login'
import Register from '@/components/register/register'
import userRoute from './user.js'
import knowledgeRoute from './knowledge.js'
import AtriclesRoute from './articles.js'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/index'
    },
    {
      path: '/index',
      component: Index
    },
    {
      path: '/knowledge',
      component: Knowledge,
      children: knowledgeRoute
    },
    {
      path: '/activity',
      component: Activity
    },
    {
      path: '/articles',
      component: Articles,
      children: AtriclesRoute
    },
    {
      path: '/write',
      component: Write
    },
    {
      path: '/user',
      component: User,
      children: userRoute
    },
    {
      path: '/login',
      component: Login
    },
    {
      path: '/register',
      component: Register
    }
  ]
})
