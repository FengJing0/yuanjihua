import Vue from 'vue'
import Router from 'vue-router'

import Index from '@/components/index/index'
import Knowledge from '@/components/knowledge/knowledge'
import Activity from '@/components/activity/activity'
import Articles from '@/components/articles/articles'
import Write from '@/components/articles/write'
import User from '@/components/user/user'
import Login from '@/components/login/login'
import Register from '@/components/register/register'

import userInfo from '@/components/user/userInfo'
import resetpwd from '@/components/user/resetpwd'
import mynote from '@/components/user/mynote'
import mycollection from '@/components/user/mycollection'
import myInfo from '@/components/user/myInfo'
import mytask from '@/components/user/mytask'
import knowledgeRoute from './knowledge.js'

import Topic from '@/components/articles/topic'

import NotFount from '@/components/notFount'

Vue.use(Router)

let router = new Router({
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
      component: Articles
    },
    {
      path: '/topic/:topic_id',
      component: Topic
    },
    {
      path: '/write',
      component: Write,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/edit/:topic_id',
      component: Write,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/user',
      component: User,
      redirect: '/user/userInfo',
      meta: {
        requireAuth: true
      },
      children: [
        {
          path: '/user/userInfo',
          component: userInfo,
          meta: {
            requireAuth: true
          }
        },
        {
          path: '/user/resetpwd',
          component: resetpwd,
          meta: {
            requireAuth: true
          }
        },
        {
          path: '/user/mynote',
          component: mynote,
          meta: {
            requireAuth: true
          }
        },
        {
          path: '/user/mycollection',
          component: mycollection,
          meta: {
            requireAuth: true
          }
        },
        {
          path: '/user/myInfo',
          component: myInfo,
          meta: {
            requireAuth: true
          }
        },
        {
          path: '/user/mytask',
          component: mytask,
          meta: {
            requireAuth: true
          }
        }
      ]
    },
    {
      path: '/login',
      component: Login
    },
    {
      path: '/register',
      component: Register
    },
    {
      path: '*',
      component: NotFount
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.length === 0) {
    from.path ? next({path: from.path}) : next({path: '/index'})
  } else {
    if (to.matched.some(res => res.meta.requireAuth)) {
      if (sessionStorage.getItem('user') || localStorage.getItem('user')) {
        next()
      } else {
        next({
          path: 'login'
        })
      }
    } else {
      next()
    }
  }
})

export default router
