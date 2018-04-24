<template>
  <div class="register-wrapper">
    <div class="register">
      <el-form>
        <el-form-item class="title">
          欢迎回到源计划
        </el-form-item>
        <el-form-item>
          <el-input v-model="phone" placeholder="请输入手机号" maxlength=11 autofocus></el-input>
        </el-form-item>
        <el-form-item class="pwd">
          <el-input v-model="pwd" type='password' placeholder="请输入6位以上的密码" minlength=6></el-input>
        </el-form-item>
        <el-form-item class="pwdAgain">
          <el-input v-model="pwdAgain" type='password' placeholder="请确认密码" minlength=6></el-input>
        </el-form-item>
        <el-form-item class='ident'>
          <el-input v-model="myIdent" :disabled='!checkPhone'></el-input>
          <Ident :disabled='!checkPhone' @test="getIdent" :phone="phone"></Ident>
        </el-form-item>
        <el-form-item class='regBtn'>
          <el-button type='danger' @click='register' :disabled='!checkForm'>注册</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import { checkPhone, checkPwd, checkIdent } from '@/common/js/regExp.js'
import Ident from '@/components/base/ident'
import Axios from 'axios'
export default {
  data () {
    return {
      phone: '13826452581',
      pwd: '931022',
      pwdAgain: '931022',
      myIdent: '',
      isGetIdent: false,
      ident: ''
    }
  },
  methods: {
    register () {
      if (this.checkForm) {
        Axios.post('/api/static/data/register.php', {
          mobile: this.phone,
          pwd: this.pwd,
          sms_code: this.myIdent
        }).then(
          res => {
            let data = res.data
            if (data.status === 1) {
              this.$message({
                showClose: true,
                message: data.info,
                type: 'success'
              })
              this.$store.commit('jump', {path: '/login'})
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
    getIdent (ident) {
      this.ident = ident
      this.isGetIdent = true
      console.log(this.ident)
    }
  },
  watch: {
  },
  computed: {
    checkPhone () {
      return checkPhone(this.phone)
    },
    checkForm () {
      return this.checkPhone && checkPwd(this.pwd, this.pwdAgain) && checkIdent(this.myIdent) && this.isGetIdent && this.ident === this.myIdent
    }
  },
  components: {
    Ident
  }
}
</script>

<style lang="stylus">
@import '../../common/css/variable.styl';
.register-wrapper
  margin:50px auto
  width:100%
  max-width:1100px
  min-width:960px
  .register
    margin:0 auto
    box-shadow :0px 0px 5px 0px $color-desc
    padding:30px 60px
    width:300px
    .title>div
      text-align :center
      font-size:$font-size-normal
      border-bottom:1px solid $color-title
    .ident>div
      display:flex
      button
        margin-left:10px
    .regBtn>div
      text-align :center
      &>button
        width:70%
</style>
