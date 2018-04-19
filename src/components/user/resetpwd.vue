<template>
    <div>
      <h4>修改密码</h4>
      <el-row>
        <el-col :span="6">
          <p>手机号 :</p>
        </el-col>
        <el-col :span="6">
          <p></p>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="6">
          <p>新密码 :</p>
        </el-col>
        <el-col :span="6">
          <el-input v-model="newInput" placeholder="请输入新密码"/>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="6">
          <p>确认密码 :</p>
        </el-col>
        <el-col :span="6">
          <el-input v-model="againInput" placeholder="请再次输入密码"/>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="6">
          <p>验证码 :</p>
        </el-col>
        <el-col :span="6">
          <el-input v-model="identifying" placeholder="请输入验证码"/>
        </el-col>
        <el-col :span="4" :offset="2">
          <el-button type="success">获取验证码</el-button>
        </el-col>
      </el-row>
      <el-row>
        <el-col :span="8">
          <el-button type="danger">提交</el-button>
        </el-col>
      </el-row>
    </div>
</template>

<script>
export default {
  data () {
    return {
      newInput: '',
      againInput: '',
      identifying: ''
    }
  }
}
</script>

<style scoped lang="less">
  h4{
    padding:5px 0;
    border-bottom: 1px solid #000;
  }
  .el-row{
    height:60px;
    line-height: 60px;
    border-bottom: 1px solid #eee;
    .el-input{
      display: block;
    }
  }
</style>
