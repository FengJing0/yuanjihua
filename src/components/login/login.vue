<template>
  <div class="login-wrapper">
    <div class="login">
      <el-form>
        <el-form-item class="title">
          欢迎回到源计划
        </el-form-item>
        <el-form-item>
          <el-input v-model="phone" placeholder="请输入手机号" maxlength=11 autofocus></el-input>
        </el-form-item>
        <el-form-item class="pwd">
          <el-input v-model="pwd" type='password' placeholder="6-16位密码、区分大小写、不能使用空格" minlength=6></el-input>
        </el-form-item>
        <div class='autoLogin'>
          <el-checkbox v-model='checked'>下次自动登录</el-checkbox>
          <div>
            <router-link to='/user/resetpwd' class='forget'>忘记密码</router-link>
            <router-link to='/register' class='reg'>立即注册</router-link>
          </div>
        </div>
        <el-form-item  class='loginBtn'>
          <el-button type='danger' @click='login'>登录</el-button>
        </el-form-item>
        <div class='loginType'>
          <p>使用合作网站账号登录</p>
          <span class='icon-wx'></span>
        </div>
      </el-form>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'
import { mapMutations, mapActions } from 'vuex'
import { checkPhone } from '@/common/js/regExp.js'
// import {setLocal} from '@/common/js/setlocal'

export default {
  data () {
    return {
      phone: '',
      pwd: '',
      checked: false
    }
  },
  methods: {
    login () {
      if (checkPhone(this.phone)) {
        Axios.post('/static/data/login.php', {
          mobile: this.phone,
          pwd: this.pwd
        }).then(
          res => {
            let data = res.data
            if (data.status === 1) {
              this.$message({
                showClose: true,
                message: data.info,
                type: 'success'
              })
              this.setUser(data.data[0])
              sessionStorage.setItem('user', JSON.stringify(data.data[0]))
              if (this.checked) {
                if (data.data != null) {
                  this.setLocal('user')
                }
              }
              this.phone = ''
              this.pwd = ''
              this.$store.commit('jump', {path: '/user'})
            } else {
              this.$message({
                showClose: true,
                message: data.info,
                type: 'error'
              })
            }
          }
        )
      }
    },
    ...mapMutations({
      setUser: 'SET_USER'
      // setLocal: 'setLocal'
    }),
    ...mapActions({
      setLocal: 'setLocal'
    })
  }
}
</script>

<style lang="stylus">
  @import '../../common/css/variable.styl';
  .login-wrapper
    margin:50px auto
    width:100%
    max-width:1100px
    min-width:960px
    .login
      margin:0 auto
      box-shadow :0px 0px 5px 0px $color-desc
      padding:30px 60px
      width:300px
      .title>div
        text-align :center
        font-size:$font-size-normal
        border-bottom:1px solid $color-title
      .autoLogin
        display:flex
        justify-content space-between
        margin-bottom: 22px
        font-size: $font-size-middle
        .reg
          color:$color-active
      .loginBtn>div
        text-align :center
        &>button
          width:70%
      .loginType
        font-size: $font-size-small
        p
          padding-bottom:10px
        .icon-wx
          font-size:36px
          cursor pointer
</style>
