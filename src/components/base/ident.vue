<template>
  <div>
    <el-button type='success' :disabled='disabled' @click='getIdent($event)'>获取验证码</el-button>
  </div>
</template>

<script>
import Axios from 'axios'
export default {
  data () {
    return {
      ident: ''
    }
  },
  props: {
    disabled: {
      type: Boolean,
      default: false
    },
    phone: {
      type: String,
      default: ''
    }
  },
  computed: {
  },
  methods: {
    getIdent (e) {
      let t = 60
      let node = e.target
      if (node.nodeName === 'SPAN') {
        node = e.path[1]
      }
      node.disabled = true
      node.classList.add('is-disabled')
      node.innerHTML = `${t--}秒后重新获取`
      let timer = setInterval(() => {
        node.innerHTML = `${t--}秒后重新获取`
        if (t === 0) {
          node.innerHTML = '获取验证码'
          node.disabled = false
          node.classList.remove('is-disabled')
          clearInterval(timer)
          timer = null
        }
      }, 1000)
      if (node.disabled === true) {
        Axios.post('/api/static/data/sendsms.php', {
          mobile: this.phone
        }).then(res => {
          if (res.data.status === 1) {
            this.ident = res.data.data.code
            this.$emit('test', this.ident)
          }
        })
      }
    }
  }
}
</script>

<style lang="stylus">

</style>
