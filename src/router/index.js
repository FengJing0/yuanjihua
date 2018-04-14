import Vue from 'vue'
import Router from 'vue-router'
import myMain from '@/components/myMain'
import knowledge from '@/components/knowledge'
import activity from '@/components/activity'
import articles from '@/components/articles'
import write from '@/components/write'
import user from '@/components/user'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: '/',
      component: myMain
    },
    {
      path: '/knowledge',
      name: 'knowledge',
      component: knowledge
    },
    {
      path: '/activity',
      name: 'activity',
      component: activity
    },
    {
      path: '/articles',
      name: 'articles',
      component: articles
    },
    {
      path: '/write',
      name: 'write',
      component: write
    },
    {
      path: '/user',
      name: 'user',
      component: user
    }
  ]
})
