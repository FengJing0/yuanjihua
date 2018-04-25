<template>
  <div class='wrapper'>
    <div class='title'>
      修改密码
    </div>
    <div class='avatar'>
    </div>
    <div class='phone'>
        <span class='title'>
          手机号:
        </span>
      <span class='content'>
          {{user.mobile}}
        </span>
    </div>
    <div class='newpwd'>
        <span class='title'>
          新密码:
        </span>
      <span class='content'>
          <el-input v-model='newPwd' type='password'></el-input>
        </span>
    </div>
    <div class='renewpwd'>
        <span class='title'>
          确认密码:
        </span>
      <span class='content'>
          <el-input v-model='newRePwd' type='password'></el-input>
        </span>
    </div>
    <div>
      <span class='title'>
        验证码:
      </span>
      <span class='content ident'>
          <el-input v-model='myIdent'></el-input>
          <Ident :disabled='!checkNewPwd' @test="getIdent" :phone="user.mobile"></Ident>
        </span>
    </div>
    <div>
      <el-button type='danger' :disabled='!isChecked' @click='changeInfo' class='btn'>提交</el-button>
    </div>
  </div>
</template>
<script>
import Axios from 'axios'
import {mapGetters, mapMutations, mapActions} from 'vuex'
// import {addClass,removeClass} from 'common/js/operateClassName.js'
// import {parseCode} from 'common/js/parseCodeToJson.js'
import {checkPwd} from '@/common/js/regExp.js'

import Ident from '@/components/base/ident'

export default {
  data () {
    return {
      newPwd: '',
      newRePwd: '',
      myIdent: '',
      ident: '',
      isGetIdent: false
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    checkNewPwd () {
      return checkPwd(this.newPwd, this.newRePwd) && this.newPwd !== ''
    },
    isChecked () {
      return this.checkNewPwd && this.ident !== '' && this.ident === this.myIdent
    }
  },
  created () {
  },
  methods: {
    getIdent (ident) {
      this.ident = ident
      this.isGetIdent = true
    },
    changeInfo () {
      let newInfo = {
        pwd: this.newPwd,
        pwd2: this.newRePwd,
        sms_code: this.ident,
        mobile: this.user.mobile
      }
      Axios.post('/static/data/reset.php', newInfo).then(
        res => {
          let data = JSON.parse(res.data)
          if (data.status === 1) {
            this.setUser(data.data)
            this.upDate(data.data)
            this.$message({
              showClose: true,
              message: data.info,
              type: 'success'
            })
            // 保存token  session
          } else {
            this.$message({
              showClose: true,
              message: data.info,
              type: 'error'
            })
          }
          // this.newPwd = ''
          // this.newRePwd = ''
          // this.ident = ''
        })
    },
    ...mapActions({
      upDate: 'upDate'
    }),
    ...mapMutations({
      setUser: 'SET_USER'
    })
  },
  components: {
    Ident
  }
}
</script>
<style lang="stylus" scoped>
  @import '../../common/css/variable.styl';
  .wrapper
    padding:30px
    &>.title
      border-bottom:1px solid $color-desc
      line-height:22px
    &>div
      padding:11px
      line-height:40px
      display :flex
      border-bottom:1px solid #eee
      &:last-child
        border:none
      .title,.content
        display inline-block
      .ident
        display flex
        &>div
          margin-right 30px;
      .title
        margin-right:30px
        width:120px
        text-align:right
      .btn
        margin:10px 0px 0px 150px
        width:120px
      .content
        flex:1
        &>.el-input
          width:200px
          display inline-block
</style>
