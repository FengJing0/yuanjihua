<template>
  <div>
    <el-row :gutter="20" class="title">
      <el-col :span="4">
        <p>进行中</p>
      </el-col>
      <el-col :span="4">
        <p>已完成</p>
      </el-col>
      <el-col :span="4">
        <p>未通过</p>
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
