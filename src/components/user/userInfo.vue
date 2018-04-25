<template>
  <div class='base-wrapper'>
    <div class='title'>
      个人信息
    </div>
    <div class='avatar'>
      <!-- 上传组件 -->
      <el-upload class='upload' action='/static/data/upload.php' :show-file-list="false" :on-success="handleAvatarSuccess" :before-upload="beforeAvatarUpload" :data="{id: user.user_id}">
        <img v-lazy="'/static/data/upload/'+user.avatar">
        更换头像
      </el-upload>
    </div>
    <div class='phone'>
        <span class='title'>
          注册手机号:
        </span>
      <span class='content'>
          {{user.mobile}}
        </span>
    </div>
    <div class='nickname'>
        <span class='title'>
          昵称:
        </span>
      <span class='content'>
          <el-input v-model='newName'></el-input>
        </span>
    </div>
    <div class='sex'>
        <span class='title'>
          性别:
        </span>
      <span class='content'>
          <el-radio v-model="sex" label='1' checked>男</el-radio>
          <el-radio v-model="sex" label='2'>女</el-radio>
        </span>
    </div>
    <div>
      <el-button type='danger' @click='changeInfo' class='btn'>提交</el-button>
    </div>
  </div>
</template>
<script>
import {mapGetters, mapMutations, mapActions} from 'vuex'
import Axios from 'axios'
export default {
  data () {
    return {
      sex: '1',
      avatar: '',
      newName: '',
      token: ''
    }
  },
  computed: {
    // newName () {
    //   return this.user.nick_name
    // },
    ...mapGetters({
      user: 'user'
    })
  },
  created () {
    this.newName = this.user.nick_name
    this.avatar = this.user.avatar
    this.sex = this.user.sex
    this.token = this.user.token
  },
  methods: {
    changeInfo () {
      Axios.post('/static/data/update.php', {
        sex: this.sex,
        nick_name: this.newName,
        token: this.token
      }).then(
        res => {
          let data = res.data
          if (data.status === 1) {
            this.setUser(data.data)
            this.upDate(data.data)
          }
        }
      )
    },
    ...mapActions({
      upDate: 'upDate'
    }),
    ...mapMutations({
      setUser: 'SET_USER'
    }),
    handleAvatarSuccess (res, file) {
      this.avatar = URL.createObjectURL(file.raw)
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
<style lang="stylus" scoped>
  @import '../../common/css/variable.styl';
  .base-wrapper
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
      .title
        margin-right:30px
        width:120px
        text-align:right
      .btn
        margin:10px 0px 0px 150px
        width:120px
    .avatar
      line-height:60px
      vertical-align :middle
      .upload
        &:hover
          color:$color-active
      img
        margin:0px 30px 0px 60px
        border-radius:50%
        border:1px solid #909090
        width:60px
        height:60px
        vertical-align :middle

</style>
