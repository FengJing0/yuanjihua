<template>
    <h1>页面去旅游了，{{time}}秒后返回主页</h1>
</template>

<script>
export default {
  name: '',
  data () {
    return {
      time: 3
    }
  },
  mounted () {
    this.time = 3;
    let timer = setInterval(() => {
      if(this.time > 0){
        this.time--
      }else{
        this.$router.push({path: '/'})
        clearInterval(timer)
        timer = null
      }
    },1000)
  }
}
</script>

<style scoped>
  h1{
    text-align: center;
    margin-top:100px;
  }
</style>
