<template>
  <div>
    <h4>个人信息</h4>
    <el-row>
      <el-col :span="4">
        <el-upload
          class="avatar-uploader"
          action="https://jsonplaceholder.typicode.com/posts/"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload">
          <img v-if="imageUrl" :src="imageUrl" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>
      </el-col>
      <el-col :span="4">
        更换头像
      </el-col>
    </el-row>
    <el-row>
      <el-col :span="6">
        <p>注册手机号</p>
      </el-col>
      <el-col :span="6">
        <p></p>
      </el-col>
    </el-row>
    <el-row>
      <el-col :span="6">
        <p>昵称</p>
      </el-col>
      <el-col :span="6">
        <el-input v-model="input"/>
      </el-col>
    </el-row>
    <el-row>
      <el-col :span="6">
        <p>性别</p>
      </el-col>
      <el-col :span="6">
        <el-radio label="1" v-model="radio">男</el-radio>
        <el-radio label="2" v-model="radio">女</el-radio>
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
      radio: '1',
      input: '',
      imageUrl: ''
    }
  },
  methods: {
    handleAvatarSuccess (res, file) {
      this.imageUrl = URL.createObjectURL(file.raw)
    },
    beforeAvatarUpload (file) {
      const isJPG = file.type === 'image/jpeg'
      const isLt2M = file.size / 1024 / 1024 < 2

      if (!isJPG) {
        this.$message.error('上传头像图片只能是 JPG 格式!')
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!')
      }
      return isJPG && isLt2M
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
  .touxiang{
    background-color: #efefef;
    width:50px;
    height:50px;
    margin: 5px;
    overflow: hidden;
    border-radius: 50%;
  }
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    margin:  5px;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
  }
  .avatar {
    width: 50px;
    height: 50px;
    display: block;
  }
</style>
