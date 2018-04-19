<template>
    <div class="main">
      <h3>欢迎回到源计划</h3>
      <el-row>
        <el-col>
          <el-input v-model="phone" placeholder="请输入登录手机号"></el-input>
        </el-col>
      </el-row>
      <el-row>
        <el-col>
          <el-input v-model="pwd" placeholder="6-16位密码，区分大小写，不能使用空格"></el-input>
        </el-col>
      </el-row>
      <el-row justify="space-between">
        <el-col :span="12">
          <el-checkbox v-model="auto">下次自动登录</el-checkbox>
        </el-col>
        <el-col :span="12">
          <router-link to="/user/resetpwd">忘记密码？</router-link>
          <router-link to="/register" class="register">立即注册</router-link>
        </el-col>
      </el-row>
      <el-row>
        <el-col>
          <el-button type="danger" round class="submit" @click="login">登录</el-button>
        </el-col>
      </el-row>
      <el-row>
        <el-col>
          <span>使用合作网站账号登录</span>
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
      auto: false
    }
  },
  methods: {
    login () {
      let req = {
        mobile: this.phone,
        pwd: this.pwd
      }
      console.log(JSON.stringify(req))
      this.$http.post('http://yjhapi.agxx.club/iweb/login/check', JSON.stringify(req)).then(
        res => {
          console.log(res)
        }
      ).catch(
        err => console.log('错误：' + err)
      )
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
    .register{
      color:#EA0F2D;
    }
    .submit{
      width:200px;
    }
  }
</style>
