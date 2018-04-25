<template>
  <div class='topic-wrapper' v-loading="loading">
    <h1 class='title' >
      {{content.title}}
    </h1>
    <div class='info-wrapper'>
      <div class='nickName'>{{content.nick_name||""}}</div>
      <div>
        <span class='time'>{{time}}</span>
        <span class='browser'>浏览:{{content.browser_num||0}}</span>
        <span class='comment'>评论:{{content.comment_num||0}}</span>
      </div>
    </div>
    <div class='content' ref="content">

    </div>
    <div class='sc-wrapper' v-if='isLogin'>
      <div class=''>
        <div class='sc' @click='coll'>
          <span class='icon-sc' :class='iscoll?"active":""'></span>
          <span>收藏</span>
        </div>
        <div class='zan' @click='zan'>
          <span class='icon-thumb_up' :class='iszan?"active":""'></span>
          <span>赞</span>
        </div>
      </div>
      <div class='fx'>
        <span>分享到: </span>
        <span class='icon-wx'></span>
      </div>
    </div>
    <!-- 发布评论模块 -->
    <div  class='comment-wrapper' v-if='isLogin'>
      <el-input type='textarea' resize='none' v-model='comment' placeholder="请输入评论内容">
      </el-input>
      <div class='btn'>
        <el-button type='danger' @click="sendComment">发布评论</el-button>
      </div>
    </div>
    <div class='go-login' v-else>
      <p>
        未登录不能发布评论，请先
        <router-link to='login'>登录</router-link>
        ，或
        <router-link to='register'>注册</router-link>
      </p>
    </div>
    <!-- 评论列表 -->
    <div v-if='commentList.length&&commentList.length>0' class='comment-list'>
      <ul>
        <li v-for='item in commentList' :key='item.date' class='comment-item'>
          <div class='content-wrapper'>
            <img v-lazy='"/static/data/upload/"+item.avatar' class='avatar'>
            <div class="comment">
              <p>{{item.nick_name}}:</p>
              <p>{{item.comment}}</p>
            </div>
            <!--<span class='fh'>:</span>-->
            <!--<span>{{item.comment}}</span>-->
          </div>
          <div class='comment-btn-wrapper'>
            <span>{{getTimes(item.date)}}</span>
            <!--<span class='re-comment'>-->
                <!--回复{{ifHasComment(item)}}-->
            <!--</span>-->
          </div>
        </li>
      </ul>
       <!--加载按钮-->
      <div v-if='!moreComment' class='more-btn'>
        <el-button type='danger' @click='getCommentList'>加载更多</el-button>
      </div>
      <div v-else class='no-more'>
        <img src="../../common/imgs/end.png">
      </div>
    </div>
  </div>
  <!--<div>-->
    <!--text-->
  <!--</div>-->
</template>

<script>
  import {mapGetters} from 'vuex'
  import Axios from 'axios'
  import {UnixTimeToDateTime} from '@/common/js/UnixTimeToDateTime.js'
  export default {
    data () {
      return {
        loading: true,
        moreComment: false,
        comment: '',
        content: {},
        isLogin: false,
        iscoll: false,
        iszan: false,
        commentList: [],
        topic_id: 0,
        user_id: -1
      }
    },
    computed: {
      time () {
          return new Date(parseInt(this.content.modify_time) * 1000).toLocaleString()
        },
      ...mapGetters({
        user: 'user'
      })
    },
    methods: {
      getCommentList () {

      },
      coll () {
        this.sel('coll')
        this.iscoll = !this.iscoll
      },
      zan () {
        this.sel('zan')
        this.iszan = !this.iszan
      },
      sel (type) {
        Axios.post('/static/data/zan.php',{
          topic_id: this.topic_id,
          user_id: this.user.user_id,
          type: type
        }).then(
          res => {
            let data = res.data
            if(data.status === 1){
              this.$message({
                message: data.info,
                showClose: true,
                type: 'success'
              })
            }else{
              this.$message({
                message: data.info,
                showClose: true,
                type: 'error'
              })
            }
          }
        )

      },
      getTimes(time){
        return UnixTimeToDateTime(time);
      },
      sendComment () {
        Axios.post('/static/data/comment.php',{
          topic_id: this.topic_id,
          user_id: this.user.user_id,
          comment: this.comment
        }).then(
          res => {
            let data = res.data
            if(data.status === 1){
              this.$message({
                showClose: true,
                message: data.info,
                type: 'success'
              })
              this.$router.go(0)
            }else{
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
    mounted(){
      if(this.user_id != null) {
        Axios.get('/static/data/content.php', {
          params: {
            topic_id: this.topic_id,
            user_id: this.user_id
          }
        }).then(
          res => {
            let data = res.data
            if (data.status === 1) {
              this.content = data.data
              this.iszan = data.iszan
              this.iscoll = data.iscoll
              this.$refs.content.innerHTML = this.content.content
              this.loading = false
            }
          }
        )
      }
    },
    created () {
      let data = sessionStorage.getItem('user')
      data = JSON.parse(data)
      if(data != null){
        this.isLogin = true
        this.user_id = data.user_id
      }
      this.topic_id = this.$route.params.topic_id
      Axios.get('/static/data/commentList.php',{
        params: {
          topic_id: this.topic_id
        }
      }).then(
        res => {
          let data = res.data
          if(data.status === 1){
            this.commentList = data.data
          }else{
            // this.$message({
            //   showClose: true,
            //   message: data.info,
            //   type: 'error'
            // })
          }
        }
      )
    }
  }
</script>

<style lang="stylus" scoped>
  @import '../../common/css/variable.styl';
  .topic-wrapper
    margin:0 auto
    padding:30px 0px
    width:100%
    max-width:1100px
    min-width:960px
    .title
      text-align:center
      font-size:28px
      line-height:42px
    .info-wrapper
      text-align:center
      font-size:14px
      color:$color-desc
      line-height:20px
      & span
        margin-left:5px
    .content
      padding:0px 10px 20px 0
      margin:50px 0px 0 0px
      border-bottom:1px solid $color-desc
    .sc-wrapper
      display:flex
      justify-content :space-between
      &>div:first-child
        display :flex
        color:$color-title
        .sc,.zan
          cursor pointer
          &:hover
            color:$color-active
        span
          vertical-align :middle
        .icon-sc,.icon-thumb_up
          margin-left:10px
          font-size:18px
          line-height:40px
          &.active
            color:$color-active
      .fx
        line-height:40px
        font-size:18px
        vertical-align :middle
        .icon-wx
          font-size:24px
          position relative
          top:4px
          cursor pointer
    .comment-wrapper
      margin-top:20px
      & textarea
        height:90px
      .btn
        text-align:right
        margin:10px 10px 0px 0px
    .go-login
      margin-top:20px
      height:90px
      text-align:center
      line-height:90px
      a:hover
        color:$color-active
    .comment-list
      margin-top:20px
      background-color:#f7f8fa
      .comment-item
        display :flex
        justify-content :space-between
        padding:10px
        margin-bottom:10px
        border-bottom:1px solid #dcdcdc
        .content-wrapper
          display :flex
          align-items:center
          .avatar
            flex:0 0 45px
            width:45px
            height:45px
          p
            margin-left 10px
            padding 3px 0
            &:first-child
             font-size: $font-size-middle
            &:last-child
              font-size: $font-size-normal
        .comment-btn-wrapper
          flex:0 0 100px
          display :flex
          align-items:center
          font-size $font-size-middle
          .re-comment
            margin-left:5px
            color:$color-active
            cursor pointer
      .more-btn,.no-more
        padding:10px
        text-align:center

</style>
