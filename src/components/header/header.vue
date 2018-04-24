<template>
  <div class="header-wrapper">
    <div>
      <div class="logo-wrapper">
        <img src="static/img/logo.822452b.png">
        <h2>源计划</h2>
      </div>
      <div class="nav-wrapper">
        <ul>
          <li class="nav" v-for="item in navList" :key="item.route">
            <router-link :to="item.route">{{item.name}}</router-link>
          </li>
          <li class="nav" v-if="!isLogin">
            <router-link to="/login">登录</router-link>
          </li>
          <li class="nav" v-if="!isLogin">
            <router-link to="/register">注册</router-link>
          </li>
          <li class='nav' v-if='isLogin'>
            <el-dropdown>
              <router-link to='/home/baseInfo'>
                <img v-lazy="'/api/static/data/upload/'+user.avatar" class='avatar'>
                <span>{{user.nick_name}}</span>
              </router-link>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item v-for='item in Links' :key='item.route'>
                  <router-link :to='item.route'>
                    {{item.text}}
                  </router-link>
                </el-dropdown-item>
                <el-dropdown-item @click.native='loginOut'>
                  退出
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex'
export default {
  data () {
    return {
    }
  },
  methods: {
    loginOut () {
      sessionStorage.clear()
      localStorage.clear()
      this.clearUser()
      this.$router.push({
        path: '/login'
      })
    },
    ...mapMutations({
      clearUser: 'CLEAR_USER',
      setUser: 'SET_USER'
    }),
    ...mapActions({
      checkLocal: 'checkLocal',
      checkSession: 'checkSession'
    })
  },
  computed: {
    ...mapGetters({
      Links: 'myLinks',
      user: 'user',
      isLogin: 'isLogin',
      navList: 'navList'
    })
  },
  created () {
    this.checkLocal('user').then(
      res => {
        if (res !== false) {
          let data = JSON.stringify(res)
          sessionStorage.setItem('user', data)
        }
      }
    )
    this.checkSession('user').then(
      res => {
        if (res !== false) {
          this.setUser(res)
        }
      }
    )
  },
  mounted () {
  }
}
</script>

<style scoped lang='stylus'>
  @import '../../common/css/variable.styl';
  .header-wrapper
    border-top 1px solid $color-title
    border-bottom 1px solid rgba(0,0,0,0.2)
    width 100%
    height 65px
    background-color #fafafa
    box-shadow :0 2 10 0 rgba(0,0,0,0.1)
    &>div
      margin 0 auto
      width 100%
      max-width 1100px
      min-width 960px
      height 100%
      display flex
      justify-content space-between
    .logo-wrapper
      vertical-align bottom
      display flex
      img
        padding-top 2px
        height 60px
      h2
        line-height 65px
        color $color-title
        font-size $font-size-title
        font-weight 700
    .nav-wrapper
      li
        display inline-block
        height 62px
        line-height 65px
        cursor pointer
        &.active a
          color: $color-active
        &:hover a
          transform all 0.3s
          border-bottom 3px solid $color-active
        a
          padding 0 15px
          padding-bottom 15px
          transition border 0.3s
          &.router-link-active
            color $color-active
        .avatar
          width 36px
          height 36px
          vertical-align middle
</style>
