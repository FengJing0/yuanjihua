<template>
  <div class='article-wrapper'  v-loading="loading">
    <el-table v-if='myList.length' :data='myList'>
      <el-table-column prop='title' label='主题' width='300'></el-table-column>
      <el-table-column prop='type' label='分类' align="center"></el-table-column>
      <el-table-column prop='comment_num' label='回复' align="center"></el-table-column>
      <el-table-column prop='browser_num' label='浏览'  align="center" ></el-table-column>
      <el-table-column prop='modify_time' label='发布时间' width="100"  align="center"></el-table-column>
      <el-table-column label='操作' width='250' align="center">
        <template slot-scope="scope">
          <el-button
            size="mini"
            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
          <el-button
            size="mini"
            type="danger"
            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="block">
      <!-- span中可显示标题或文本 -->
      <span class="demonstration"></span>
      <el-pagination layout="prev, pager, next" @current-change='currentPage' :total="commentList">
      </el-pagination>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import Axios from 'axios'
export default {
  data(){
    return {
      myList: [],
      loading: true,
      user: {},
      page: null,
      commentList: 0
    }
  },
  methods:{
    currentPage(page){
      this.page = page
      this.loadList()
    },
    handleEdit(index,row){
      this.$router.push({path: '/edit/'+row.topic_id})
    },
    handleDelete(index,row){
      this.$confirm('确定删除您的帖子?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        Axios.post('/static/data/delete.php', {
          user_id: this.user.user_id,
          topic_id: row.topic_id
        }).then(
          res => {
            let data = res.data
            if(data.status === 1){
              this.$message({
                type: 'success',
                message: '删除成功!'
              });
              this.$router.go(0)
            }else {
              this.$message({
                type: 'error',
                message: data.info
              });
            }
          }
        )
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消删除'
        });
      })
    },
    getType(num){
      switch(num){
        case '1':
          return '入门学习';
        case '2':
          return '经验分享';
        case '3':
          return '成果分享';
        default:
          return '其他分享';
      }
    },
    loadList(){
      Axios.get('/static/data/myNote.php', {
        params: {
          user_id: this.user.user_id,
          page: this.page
        }
      }).then(
        res => {
          let data = res.data
          if(data.status === 1){
            this.myList = data.data
            this.commentList = parseInt(data.commentList[0])
            for(let i in this.myList){
              this.myList[i].type = this.getType(this.myList[i].type)
              this.myList[i].modify_time = new Date(parseInt(this.myList[i].modify_time) * 1000).toLocaleString()
            }
            this.loading = false
          }
        }
      )
    }
  },
  created () {
    let data = JSON.parse(sessionStorage.getItem('user'))
    this.user = data
    this.loadList()
  }
}
</script>

<style scoped lang="stylus">
  .article-wrapper
    padding:30px
  .block
    margin-top:50px
    text-align:center
</style>
