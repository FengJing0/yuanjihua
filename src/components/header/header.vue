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
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
// import {mapGetters, mapMutations} from 'vuex'
import {mapGetters} from 'vuex'
export default {
  data () {
    return {
      isLogin: false
    }
  },
  // methods: {
  //   ...mapMutations({
  //     CLEAR_USER: 'CLEAR_USER',
  //     SET_USER: 'SET_USER'
  //   })
  // },
  computed: {
    ...mapGetters({
      Links: 'myLinks',
      user: 'user',
      navList: 'navList'
    })
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
