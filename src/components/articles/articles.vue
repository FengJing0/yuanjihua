<template>
    <div>
      <List :targetsTech="navList" :sort="true"></List>
      <!--<ul class="nav clear">-->
        <!--<li v-for="(nav,index) in navList" :key="index">-->
          <!--<router-link :to="nav.router">-->
            <!--<span></span>-->
            <!--<p>  {{nav.name}}</p>-->
          <!--</router-link>-->
        <!--</li>-->
      <!--</ul>-->
      <router-view></router-view>
    </div>
</template>

<script>
import List from '../base/list'
export default {
  data () {
    return {
      navList: [
        {'text': '所有分类', 'router': '/articles/home'},
        {'text': '经验分享', 'router': '/articles/jingyan'},
        {'text': '入门学习', 'router': '/articles/rumen'},
        {'text': '成果分享', 'router': '/articles/chengguo'}
      ]
    }
  },
  components: {
    List
  }
}
</script>

<style scoped lang="less">
  .nav{
    li{
      float: left;
      margin:0 10px;
      font-size:12px;
      span{
        display: inline-block;
        width:12px;
        height: 12px;
        line-height: 12px;
        background-color: red;
      }
      p{
        display: inline-block;
      }
    }
  }
</style>
