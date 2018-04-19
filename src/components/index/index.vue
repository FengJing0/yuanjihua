<template>
  <div>
    <el-carousel trigger="click" height="500px">
      <el-carousel-item v-for="(item,index) in bannerList" :key="index">
        <img :src="'../static/img/'+item.imgUrl" alt="">
      </el-carousel-item>
    </el-carousel>
    <List :targetsTech='targets' :comment="true"></List>
  </div>
</template>

<script>
// import { mapState } from 'vuex'
import List from '../base/list'
export default {
  data () {
    return {
      bannerList: [
        {imgUrl: 'banner1.jpg'},
        {imgUrl: 'banner2.jpg'},
        {imgUrl: 'banner3.jpg'}
      ],
      targets: [
        {text: '热门文章', id: 0},
        {text: 'html', id: 1},
        {text: 'php', id: 2},
        {text: 'java', id: 3}
      ]
    }
  },
  components: {
    List
  },
  methods: {
    handleClick (tab, event) {
      console.log(tab, event)
    }
  }
}
</script>

<style scoped>

</style>
