<template>
  <div>
    <el-row :gutter="20" class="title">
      <el-col :span="8">
        <p>主题</p>
      </el-col>
      <el-col :span="4">
        <p>分类</p>
      </el-col>
      <el-col :span="4">
        <p>回复</p>
      </el-col>
      <el-col :span="4">
        <p>浏览</p>
      </el-col>
      <el-col :span="4">
        <p>发布时间</p>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
}
</script>

<style scoped lang="less">
  .title{
    padding:5px 0;
    border-bottom: 1px solid #000;
  }
</style>
