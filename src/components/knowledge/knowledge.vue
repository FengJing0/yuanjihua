<template>
  <div>
    <el-menu :default-active="$route.path" class="nav" mode="horizontal" active-text-color="#EA0F2D">
      <el-menu-item v-for="(nav,index) in navList"
                    :key="index"
                    :index="nav.router"
                    @click="$store.commit('jump',nav.router)">
        {{nav.name}}
      </el-menu-item>
    </el-menu>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  data () {
    return {
      navList: [
        {
          'name': '全部',
          'router': '/knowledge/all'
        },
        {
          'name': 'html',
          'router': '/knowledge/html'
        },
        {
          'name': 'javascript',
          'router': '/knowledge/javascript'
        },
        {
          'name': 'php',
          'router': '/knowledge/php'
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>
