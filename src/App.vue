<template>
  <div id="app">
    <el-container>
      <el-header class="header">
        <el-row>
          <el-col :span="6" :offset="2">
            <img src="../static/img/logo.822452b.png" class="fl">
            <h2 class="fl">源计划</h2>
          </el-col>
          <el-col :span="14" :offset="2">
            <el-menu :default-active="$route.path" class="nav" mode="horizontal" active-text-color="#EA0F2D">
              <el-menu-item v-for="(nav,index) in navList"
                            :key="index"
                            :index="nav.route"
              @click="$store.commit('jump',nav.route)">
                {{nav.name}}
              </el-menu-item>
            </el-menu>
          </el-col>
        </el-row>
      </el-header>
      <el-main class="main">
        <router-view/>
      </el-main>
    </el-container>
  </div>
</template>

<script>
// import { mapState } from 'vuex'
export default {
  data () {
    return {
      navList: [
        {
          name: '首页',
          route: '/myMain'
        },
        {
          name: '知识体系',
          route: '/knowledge'
        },
        {
          name: '活动中心',
          route: '/activity'
        },
        {
          name: '文章',
          route: '/articles'
        },
        {
          name: '写文章',
          route: '/write'
        },
        {
          name: '未读消息',
          route: '/user'
        },
        {
          name: '登录',
          route: '/login'
        },
        {
          name: '注册',
          route: '/register'
        }
      ]
    }
  }
}
</script>

<style lang="less">
  body,h1,h2,h3,h4,h5,p{
    margin:0;
    font-weight: normal;
  }
  a{
    color:#000;
    text-decoration: none;
  }
  img{
    width: 100%;
    display: block;
  }
  ul{
    padding-left:0;
    margin:0;
    li{
    margin:0;
    list-style: none;
    }
  }
  .clear:after{
    content: '';
    clear:both;
    display: block;
  }
  .fl{
    float: left;
  }
  .fr{
    float: right;
  }
  .header{
    /*position: fixed;*/
    /*width:100%;*/
    /*top:0;*/
    /*left:0;*/
    min-width: 1150px;
    line-height: 60px;
    border:none;
    box-shadow: 0 2px 10px 0 rgba(0,0,0,.1),0 1px rgba(0,0,0,.1);
    img{
      width:auto;
      height:60px;
    }
    .nav{
      color:#000;
      li{
        color:#000;
        &:hover{
          border-bottom: 2px solid #EA0F2D;
        }
        .active{
          color:#EA0F2D;
        }
      }
    }
  }
  .main{
    min-width: 1150px;
  }
</style>
