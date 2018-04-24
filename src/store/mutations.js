import router from '../router'
import * as types from './mutation-type'

const mutations = {
  [types.SET_USER] (state, user) {
    state.user = user
    state.isLogin = true
  },
  [types.CLEAR_USER] (state) {
    state.user = {}
    state.isLogin = false
  },
  jump (state, path) {
    router.push(path)
  }
}

export default mutations
