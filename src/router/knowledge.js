import all from '@/components/knowledge/all'
import html from '@/components/knowledge/html'
import javascript from '@/components/knowledge/javascript'
import php from '@/components/knowledge/php'

export default [
  {
    path: '',
    redirect: '/knowledge/all'
  },
  {
    path: '/knowledge/all',
    component: all
  },
  {
    path: '/knowledge/html',
    component: html
  },
  {
    path: '/knowledge/javascript',
    component: javascript
  },
  {
    path: '/knowledge/php',
    component: php
  }
]
