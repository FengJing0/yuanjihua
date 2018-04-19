<template>
  <div id="app">
      <Header></Header>
      <router-view/>
  </div>
</template>

<script>
import Header from './components/header/header'
// import { mapState } from 'vuex'
export default {
  components: { Header }
}
</script>

<style lang='stylus'>
@import './common/css/initStyle.styl';
  .clear:after
    content: '';
    clear:both;
    display: block;
  .fl
    float: left;
  .fr
    float: right;
  .main
    min-width: 1150px;
</style>
