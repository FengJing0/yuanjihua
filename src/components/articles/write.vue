<template>
  <div class='write-wrapper' v-loading='loading'>
    <div class='write'>
      <el-form ref='form'>
        <el-form-item  class='title-wrapper'>
          <el-form-item class='left'>
            <span>文章标题:</span>
            <el-input v-model='article.title' ></el-input>
          </el-form-item>
          <el-form-item class='right' >
            <el-form-item label=''>
              <span>所属分类:</span>
              <el-select v-model='article.tech_type'>
                <el-option v-for='item in optionList' :key='item.value' :label='item.label' :value='item.value'></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label=''>
              <span>技术分类:</span>
              <el-select v-model='article.type'>
                <el-option v-for='item in classList' :key='item.value' :label='item.label' :value='item.value'></el-option>
              </el-select>
            </el-form-item>
          </el-form-item>
        </el-form-item>
        <el-form-item>
          <!-- 编辑器 -->
          <quill-editor ref="myTextEditor"
                        v-model="article.content"
                        :options="editorOption"
                        @change="onEditorChange($event)">
          </quill-editor>
        </el-form-item>
        <el-form-item class='btn-wrapper'>
          <el-button @click='issue' class='issueBtn' type='danger' :disabled="!check">发布</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import Axios from 'axios'
import {mapGetters} from 'vuex'
export default {
  data () {
    return {
      loading: true,
      article: {
        title: '',
        content: '',
        type: '',
        tech_type: '',
        md_content: '',
        isEdit: false,
      },
      user: {},
      editorOption: {
        // something config
        // 编辑器配置
        toolbar: [
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          [{ 'header': 1 }, { 'header': 2 }],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          [{ 'script': 'sub' }, { 'script': 'super' }],
          [{ 'indent': '-1' }, { 'indent': '+1' }],
          [{ 'direction': 'rtl' }],
          [{ 'size': ['small', false, 'large', 'huge'] }],
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
          [{ 'font': [] }],
          [{ 'color': [] }, { 'background': [] }],
          [{ 'align': [] }],
          ['clean'],
          ['link', 'image', 'video']
        ],
        syntax: {
          highlight: text => hljs.highlightAuto(text).value
        }
      },
      optionList: [
        {value: '1', label: '经验分享'},
        {value: '2', label: '入门学习'},
        {value: '3', label: '成果分享'}
      ],
      classList: [
        {value: '1', label: 'html'},
        {value: '2', label: 'php'},
        {value: '3', label: 'java'}
      ]
    }
  },
  computed: {
    check () {
      for (let key in this.article) {
        if (this.article[key] === '') {
          return false
        }
      }
      return true
    },
  },
  methods: {
    issue () {
      let para = this.article
      Object.assign(para, this.user)
      para.isEdit = this.isEdit
      para.topic_id = this.$route.params.topic_id
      Axios.post('/static/data/writeArticle.php', para).then(
        res => {
          let data = res.data
          if (data.status === 1) {
            this.$message({
              message: data.info,
              showClose: true,
              type: 'success'
            })
            this.$store.commit('jump', {path: '/articles'})
          } else {
            this.$message({
              message: data.info,
              showClose: true,
              type: 'error'
            })
          }
        }
      )
    },
    onEditorChange ({ editor, html, text }) {
      // console.log('editor change!', editor, html, text)
      this.article.content = html
      this.article.md_content = text
    }
  },
  created () {
    this.user = JSON.parse(sessionStorage.getItem('user'))
    if(this.$route.params.topic_id){
      this.isEdit = true
      Axios.get('/static/data/content.php',{
        params:{
          topic_id: this.$route.params.topic_id,
          user_id: this.user.user_id
        }
      }).then(
        res => {
          let data = res.data
          if(data.status === 1){
            this.article.title = data.data.title,
            this.article.content = data.data.content,
            this.article.type = data.data.type,
            this.article.tech_type = data.data.tech_type,
            this.article.md_content = data.data.md_content
            this.loading = false
          }
        }
      )
    }else {
      this.loading = false
    }
    // this.user = JSON.parse(sessionStorage.getItem('user'))
  },
  mounted () {
    console.log(this.user)
  }
}
</script>

<style lang="stylus" scoped>
  .write-wrapper
    margin:50px auto
    width:100%
    min-width:960px
    max-width:1100px
    .title-wrapper
      width:100%
      .left,.right
        width:40%
        display inline-block
      .left>div>div
        display :flex
        justify-content :space-between
      .left .el-input
        width:75%
        display inline-block
      .right
        width:58%
        margin-left:10px
        &>div
          display :flex
          justify-content :flex-start
        .el-form-item
          display inline-block
          .el-form-item__content
            display inline-block
            width:20px
    .quill-editor
      height:550px
    .btn-wrapper
      position:relative
      .issueBtn
        width:120px
        position:absolute
        right:50px
</style>
