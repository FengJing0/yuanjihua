<template>
  <div class='content-wrapper'>
  <div class='slider-wrapper'>
    <el-carousel  trigger="click" class='slider'>
      <el-carousel-item v-for='item in bannerList' :key='item.url'>
        <!--<h2>{{item.title}}</h2>-->
        <img v-lazy="'/static/img/'+item.url">
      </el-carousel-item>
    </el-carousel>
  </div>
  <div class='article-wrapper'>
    <!-- 数据未完成加载时提示 -->
    <!--<div v-if='!loaded' class='loading'>-->
      <!--<img src="static/imgs/loading.gif">-->
      <!--<p>资源正在加载中...</p>-->
    <!--</div>-->
    <!--<List @reloadList='reloadList' v-else :pageInfo='articleList.data' :list='articleList' :targetsTech='targets'></List>-->
    <List class='article' v-if='loaded' :isIndex="true" :comment="true"  :targetsTech="targets" :list="topicList" :listCount="listCount"></List>
    <div v-if='!loaded' class='loading'>
      <img src="/static/img/loading.gif">
      <p>资源正在加载中...</p>
    </div>
  </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import List from '../base/list'
export default {
  data () {
    return {
      articleList: [],
      topicList:[],
      loaded: false,
      listCount: 0,
      bannerList: [
        {url: 'banner1.jpg'},
        {url: 'banner2.jpg'},
        {url: 'banner3.jpg'}
      ],
      targets: [
        {text: '热门文章'},
        {text: 'html'},
        {text: 'php'},
        {text: 'java'}
      ]
    }
  },
  created () {
    let data = sessionStorage.getItem('user')
    data = JSON.parse(data)
    this.$axios.get('/static/data/topicList.php',{
      params: {
        index: true,
        type: 0,
        sort: 'new',
        page: null
      }
    }).then(
      res => {
        let data = res.data
        if (data.status === 1) {
          this.topicList = data.data
          this.loaded = true
          this.listCount = parseFloat(data.listCount[0])
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
  components: {
    List
  },
  methods: {
  }
}
</script>

<style lang="stylus" scoped>
  .content-wrapper
    margin:0 auto
    margin-top:40px
    padding-bottom:150px
    width:100%
    max-width:1100px
    min-width:960px
    .slider-wrapper
      width:100%
      height:300px
      .el-carousel__item h3
        color: #475669
        font-size: 14px
        opacity: 0.75
        line-height: 150px
        margin: 0
      .el-carousel__item:nth-child(2n)
        background-color: #99a9bf
      .el-carousel__item:nth-child(2n+1)
        background-color: #d3dce6
      .slider
        h2
          text-align:center
          color:white
          line-height:300px
    .article-wrapper
      width:100%
      .loading
        margin-top:20px
        text-align:center
        p
          margin-top:20px
      .article
        margin-top:50px
</style>
