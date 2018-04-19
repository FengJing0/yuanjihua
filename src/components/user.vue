<template>
  <div>
   <el-row>
     <el-col :span="6">
       <el-menu :default-active="$route.path" active-text-color="#EA0F2D" :router="true">
         <el-menu-item v-for="(nav,index) in userNav"
                       :key="index"
                       :index="nav.route"
                       class="menu">
           <h3>{{nav.title}}</h3>
         </el-menu-item>
       </el-menu>
     </el-col>
     <el-col :span="17" :offset="1">
       <router-view></router-view>
     </el-col>
   </el-row>
  </div>
</template>

<script>
export default {
  name: 'user',
  data () {
    return {
      userNav: [
        {
          title: '我的信息',
          route: '/user/userInfo'
        },
        {
          title: '修改密码',
          route: '/user/resetpwd'
        },
        {
          title: '我的帖子',
          route: '/user/mynote'
        },
        {
          title: '我的收藏',
          route: '/user/mycollection'
        },
        {
          title: '我的消息',
          route: '/user/myInfo'
        },
        {
          title: '我的任务',
          route: '/user/mytask'
        }
      ],
      path: this.$route.path
    }
  }
}
</script>

<style scoped>
  h3{
    font-size:16px;
    text-align: center;
  }
  .menu{
    border-bottom:1px solid #BABABA;
    margin:0 50px;
  }
</style>
