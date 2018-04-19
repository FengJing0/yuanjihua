<template>
    <div>
      <el-row class="title">
        <el-col :span="2">
          <label>文章标题</label>
        </el-col>
        <el-col :span="8">
          <el-input type="text" placeholder="输入文章标题" v-model="title"></el-input>
        </el-col>
        <el-col :span="2" :offset="2">
          <span>所属分类</span>
        </el-col>
        <el-col :span="4">
          <el-select v-model="value" placeholder="请选择">
            <el-option v-for="item in optionList" :key="item.value" :label="item.label" :value="item.val"></el-option>
          </el-select>
        </el-col>
        <el-col :span="2">
          <span>技术分类</span>
        </el-col>
        <el-col :span="4">
          <el-select v-model="value" placeholder="请选择">
            <el-option v-for="item in classList" :key="item.value" :label="item.label" :value="item.val"></el-option>
          </el-select>
        </el-col>
      </el-row>
      <el-row class="write">
        <el-col :span="11" :offset="1">
          <!--<el-input type="textarea" v-model="text" @keyup.native="handleMark" resize="none"></el-input>-->
          <quill-editor ref="myTextEditor"
                        v-model="content"
                        :config="editorOption"
                        @blur="onEditorBlur($event)"
                        @focus="onEditorFocus($event)"
                        @ready="onEditorReady($event)">
          </quill-editor>
        </el-col>
        <el-col :span="11">
          <div ref="show"></div>
        </el-col>
      </el-row>
    </div>
</template>

<script>
export default {
  data () {
    return {
      title: '',
      content: '',
      value: '',
      editorOption: {
        // something config
        readOnly: true,
        placeholder: '请在这里输入您的内容'
      },
      optionList: [
        {
          val: '经验分享'
        },
        {
          val: '入门学习'
        },
        {
          val: '成果分享'
        }
      ],
      classList: [
        {
          val: 'php'
        },
        {
          val: 'java'
        },
        {
          val: 'html'
        }
      ]
    }
  },
  computed: {
    editor () {
      return this.$refs.myTextEditor.quillEditor
    }
  },
  methods: {
    handleMark () {
      this.$refs.show.innerHTML = this.text
      console.log(this.text)
    },
    onEditorBlur (editor) {
      console.log('editor blur!', editor)
    },
    onEditorFocus (editor) {
      console.log('editor focus!', editor)
    },
    onEditorReady (editor) {
      console.log('editor ready!', editor)
    }
  },
  mounted () {
  }
}
</script>

<style scoped lang="less">
  .title{
    text-align: center;
    line-height: 40px;
  }
  .write{
    margin-top: 20px;
    .el-textarea{
      height:300px;
    }
    textarea{
      height:300px;
    }
  }
</style>
