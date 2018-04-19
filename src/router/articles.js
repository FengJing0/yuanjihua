import home from '@/components/articles/home'
import jingyan from '@/components/articles/jingyan'
import rumen from '@/components/articles/rumen'
import chengguo from '@/components/articles/chengguo'

export default [
  {
    path: '',
    redirect: '/articles/home'
  },
  {
    path: '/articles/home',
    component: home
  },
  {
    path: '/articles/jingyan',
    component: jingyan
  },
  {
    path: '/articles/rumen',
    component: rumen
  },
  {
    path: '/articles/chengguo',
    component: chengguo
  }
]
