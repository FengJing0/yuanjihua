<template>
    <div class="wrapper">
      <div class="tags">
        <el-tag v-if="targetsTech.length>0" v-for="(item,index) in targetsTech" :key="index" :type="index==tech_type?'':'info'" @click.native="loadList($event,index)" class="tag">
          {{item.text}}
        </el-tag>
      </div>
      <div v-if='sort' class='sort-wrapper'>
        <div class='new' @click='toggleSortType($event)' :class='tsort=="new"?"active":""'>最新</div>
        <div class='hot' @click='toggleSortType($event)' :class='tsort=="hot"?"active":""'>最热</div>
      </div>
      <div v-if="result.length>0">
        <!--文章列表-->
        <ul class='list-wrapper'>
          <li v-for='item in result' :key='item.topic_id'>
            <div class='user-wrapper'>
              <span class='user'>
                  {{item.nick_name}}
              </span>
              <span class='time'>
                  {{getTimes(item.modify_time)}}
              </span>
            </div>
            <div class='title-wrapper' @click="$store.commit('jump', {path: '/topic/'+item.topic_id})">
              <div>{{item.title}}</div>
              <div class='comment-wrapper' v-if='comment'>
                <div>
                  <span class='icon-twitch'></span>
                  <span class='comment' >{{item.comment_num}}</span>
                </div>
                <div>
                  <span class='icon-thumb_up'></span>
                  <span class='like'>{{item.like_num}}</span>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <!--分页-->
        <div class='pagination' >
          <el-pagination @current-change='changePage' background layout="prev, pager, next" :total='count'></el-pagination>
        </div>
      </div>
      <div v-else class='no-data'>
        暂无数据
      </div>
    </div>
</template>

<script>
import Axios from 'axios'
import { mapActions } from 'vuex'
import {UnixTimeToDateTime} from '@/common/js/UnixTimeToDateTime.js'
export default {
  data () {
    return {
      hot: false,
      tech_type: 0,
      tsort: 'new',
      result: [],
      count: 0,
      page: null
    }
  },
  props: {
    targetsTech: { // 导航信息
      type: Array,
      default: function () {
        return []
      }
    },
    listCount:{//总条数
      type: Number,
      default: 0
    },
    isIndex: {// 是否是首页
      type: Boolean,
      default: false
    },
    list: { // 默认加载列表
      type: Array,
      default: function () {
        return []
      }
    },
    sort: {// 是否加载排序最新、最热
      type: Boolean,
      default: false
    },
    comment: {// 是否加载评论
      type: Boolean,
      default: false
    }
  },
  methods: {
    toggleSortType (e) {
      if (e.target.className.indexOf('active') === -1) {
        this.tsort = e.target.classList[0]
        this.load()
      }
    },
    getTimes(time){
      return UnixTimeToDateTime(time);
    },
    loadList (e, index) {
      if (e.target.className.indexOf('el-tag--info') >= 0) {
        this.tech_type = index
        this.load()
      }
    },
    changePage (page) {
      this.page = page
      this.load()
    },
    load () {
      Axios.get('/static/data/topicList.php',{
        params: {
          index: this.isIndex,
          page: this.page,
          type: this.tech_type,
          sort: this.tsort
        }
      }).then(
        res => {
          let data = res.data
          if (data.status === 1) {
            this.result = data.data
            this.loaded = true
            this.count = parseFloat(data.listCount[0])
          }else{
            this.$message({
              message: data.info,
              showClose: true,
              type: 'error'
            })
          }
        }
      )
    }
  },
  created () {
    if (this.list.length > 0) {
      this.result = this.list
    }
    if(this.listCount > 0){
      this.count = this.listCount
    }
  }
}
</script>

<style scoped lang="stylus">
@import '../../common/css/variable.styl';
.wrapper
  .tags
    border-bottom:1px solid black
    line-height:50px
    .tag
      margin-right:20px
      cursor pointer
      &:hover
        color:$color-active
    .tagType
      margin-right:20px
      cursor pointer
      &:hover
        color:$color-active
  .list-wrapper
    li
      padding:20px 0px
      border-bottom:1px solid #ddd
      .user-wrapper
        width:100%
        font-size:$font-size-small
        color:$color-desc
        line-height:16px
        .time
          margin-left:5px
          &:before
            content:'·'
          &:after
            content:'·'
      .title-wrapper
        margin-top:10px
        display :flex
        justify-content :space-between
        cursor pointer
        .comment-wrapper
          &>div
            display inline-block
  .pagination
    margin-top:30px
    text-align:center
  .no-data
    text-align:center
    line-height:80px
  .sort-wrapper
    padding:10px 10px 0px 0px
    line-height:50px
    display :flex
    &>div
      width:50px
      height:30px
      text-align:center
      line-height:30px
      font-size:12px
      cursor pointer
      &:first-child
        margin-right:10px
      &.active
        background-color:$color-active
        color:white
</style>
