<template>
  <div class="main">
    <h3>欢迎回到源计划</h3>
    <el-row>
      <el-col>
        <el-input v-model="phone" placeholder="请输入手机号"></el-input>
      </el-col>
    </el-row>
    <el-row>
      <el-col>
        <el-input type="password" v-model="pwd" placeholder="请输入6位以上的密码"></el-input>
      </el-col>
    </el-row>
    <el-row>
      <el-col>
        <el-input type="password" v-model="pwdAgain" placeholder="请确认密码"></el-input>
      </el-col>
    </el-row>
    <el-row justify="space-between">
      <el-col :span="12">
        <el-input v-model="validation" placeholder="请输入短信验证码"></el-input>
      </el-col>
      <el-col :span="12">
        <el-button type="success">获取验证码</el-button>
      </el-col>
    </el-row>
    <el-row>
      <el-col>
        <el-button type="danger" round class="submit">注册</el-button>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data () {
    return {
      phone: '',
      pwd: '',
      pwdAgain: '',
      validation: '',
      phoneRge: /^1[34578]\d{9}$/,
      pwdRge: /^\d{6,}$/
    }
  },
  methods: {
    getCode () {
      if (this.phoneRge.test(this.phone)) {
        let req = {
          mobile: '13333333333'
        }
        let phone = JSON.stringify(req)
        console.log(phone)
        this.$http.post('http://yjhapi.agxx.club/iweb/Sendsms/send', phone).then(
          res => {
            // let data = JSON.stringify(res.data)
            // let result = JSON.parse(data)
            // alert(result)
            console.log(res.data)
          }
        ).catch(
          err => console.log('err:~~' + err)
        )
      }
    },
    register () {
      if (this.pwd === this.pwdAgain && this.phoneRge.test(this.phone) && this.validation === '123456' && this.pwdRge.test(this.pwd)) {
        let req = {
          mobile: this.phone,
          pwd: this.pwd,
          sms_code: this.validation
        }
        let obj = JSON.stringify(req)
        this.$http.post('http://yjhapi.agxx.club/iweb/regist/index', req).then(
          res => {
            console.log(res)
          }
        ).catch(
          err => console.log('错误' + err)
        )
        console.log(obj)
      } else {
        console.log(0)
      }
    }
  }
}
</script>

<style scoped lang="less">
  .main{
    width:300px;
    padding:30px 60px;
    margin: 0 auto;
    box-shadow: 1px 1px 6px 0 rgba(0,0,0,.2);
    text-align: center;
    h3{
      padding:5px 0;
      border-bottom: 1px solid #000;
    }
    .el-col{
      margin-top: 20px;
    }
    a{
      font-size:14px;
    }
    .submit{
      width:200px;
    }
  }
</style>
