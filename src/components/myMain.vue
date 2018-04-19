<template>
  <div>
    <el-carousel trigger="click" height="500px">
      <el-carousel-item v-for="(item,index) in bannerList" :key="index">
        <img :src="'../static/img/'+item.imgUrl" alt="">
      </el-carousel-item>
    </el-carousel>
    <el-tabs v-model="$store.state.activeName" @tab-click="handleClick">
      <el-tab-pane :label="article.title" :name="article.name" v-for="(article,index) in $store.state.articleList" :key="index">
        <div v-for="(content,index) in article.content" :key="index" class="list">
          <p>{{content.class}}·{{content.publishDate}}</p>
          <div class="content clear">
            <h3 class="fl">{{content.title}}</h3>
            <div class="fr">
              <span>评论</span>
              <span>{{content.comment}}</span>
              <span>喜欢</span>
              <span>{{content.like}}</span>
            </div>
          </div>
        </div>
      </el-tab-pane>
      <el-pagination
        background
        layout="prev, pager, next"
        :total="100"
        :page-size="4"
      style="text-align: center;">
      </el-pagination>
    </el-tabs>
  </div>
</template>

<script>
// import { mapState } from 'vuex'
export default {
  data () {
    return {
      bannerList: [
        {
          imgUrl: 'banner1.jpg'
        },
        {
          imgUrl: 'banner2.jpg'
        },
        {
          imgUrl: 'banner3.jpg'
        }
      ]
    }
  },
  methods: {
    handleClick (tab, event) {
      console.log(tab, event)
    }
  }
}
</script>

<style scoped lang="less">
  .list{
    padding:5px 0;
    border-bottom: 1px solid #ddd;
    &>p{
      color:#909090;
      font-size:12px;
    }
    .content{
      padding:15px 0;
      h3{
        color:#2E3135;
        font-size:20px;
      }
      div{
        font-size:14px;
        line-height: 26px;
      }
    }
  }
</style>
