<template>
    <div class='article-wrapper'>
      <List v-if='loaded' :targetsTech="navList" :sort="true" :comment="true" :list="topicList" :listCount="listCount"></List>
      <div v-if='!loaded' class='loading'>
        <img src="../../../static/img/loading.gif">
        <p>资源正在加载中...</p>
      </div>
    </div>
</template>

<script>
import List from '../base/list'
import { mapGetters } from 'vuex'
import Axios from 'axios'
export default {
  data () {
    return {
      navList: [
        {'text': '所有分类'},
        {'text': '经验分享'},
        {'text': '入门学习'},
        {'text': '成果分享'}
      ],
      topicList:[],
      loaded: false,
      listCount: 0
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    })
  },
  created () {
    let data = sessionStorage.getItem('user')
    data = JSON.parse(data)
    Axios.get('/api/static/data/topicList.php',{
      params: {
        index: false,
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
  }
}
</script>

<style scoped lang="stylus">
  .article-wrapper
    margin:0 auto
    width:100%
    max-width:1100px
    min-width:960px
</style>
