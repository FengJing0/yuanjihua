<template>
    <div>
      <ul class="nav clear">
        <li v-for="(nav,index) in navList" :key="index">
          <router-link :to="nav.router">
            <span></span>
            <p>  {{nav.name}}</p>
          </router-link>
        </li>
      </ul>
      <router-view></router-view>
    </div>
</template>

<script>
export default {
  data () {
    return {
      navList: [
        {
          'name': '所有分类',
          'router': '/articles/home'
        },
        {
          'name': '经验分享',
          'router': '/articles/jingyan'
        },
        {
          'name': '入门学习',
          'router': '/articles/rumen'
        },
        {
          'name': '成果分享',
          'router': '/articles/chengguo'
        }
      ]
    }
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
