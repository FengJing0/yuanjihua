import Vue from 'vue'
import Router from 'vue-router'
import myMain from '@/components/myMain'
import knowledge from '@/components/knowledge'
import activity from '@/components/activity'
import articles from '@/components/articles'
import write from '@/components/write'
import user from '@/components/user'
import login from '@/components/login'
import register from '@/components/register'
import userRoute from './user.js'
import knowledgeRoute from './knowledge.js'
import AtriclesRoute from './articles.js'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/myMain'
    },
    {
      path: '/myMain',
      component: myMain
    },
    {
      path: '/knowledge',
      component: knowledge,
      children: knowledgeRoute
    },
    {
      path: '/activity',
      component: activity
    },
    {
      path: '/articles',
      component: articles,
      children: AtriclesRoute
    },
    {
      path: '/write',
      component: write
    },
    {
      path: '/user',
      component: user,
      children: userRoute
    },
    {
      path: '/login',
      component: login
    },
    {
      path: '/register',
      component: register
    }
  ]
})
