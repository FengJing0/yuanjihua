<template>
  <div>
   <el-row>
     <el-col :span="6">
       <el-menu default-active="userInfo" active-text-color="#EA0F2D">
         <el-menu-item v-for="(nav,index) in $store.state.userNav"
                       :key="index"
                       :index="nav.route" class="menu">
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
  name: 'user'
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
