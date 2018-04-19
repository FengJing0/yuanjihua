import userInfo from '@/components/user/userInfo'
import resetpwd from '@/components/user/resetpwd'
import mynote from '@/components/user/mynote'
import mycollection from '@/components/user/mycollection'
import myInfo from '@/components/user/myInfo'
import mytask from '@/components/user/mytask'

export default [
  {
    path: '',
    redirect: '/user/userInfo'
  },
  {
    path: '/user/userInfo',
    component: userInfo
  },
  {
    path: '/user/resetpwd',
    component: resetpwd
  },
  {
    path: '/user/mynote',
    component: mynote
  },
  {
    path: '/user/mycollection',
    component: mycollection
  },
  {
    path: '/user/myInfo',
    component: myInfo
  },
  {
    path: '/user/mytask',
    component: mytask
  }
]
