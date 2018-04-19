<template>
    <div class="wrapper">
      <div class="tag">
        <el-tag v-if="targetsTech.length>0" v-for="(item,index) in targetsTech" :key="index" :type="index==tech_type?'':'info'" @click.native="loadList($event,index)" class="tag">
          {{item.text}}
        </el-tag>
      </div>
      <div v-if='sort' class='sort-wrapper'>
        <div class='new' @click='toggltSortType($event)' :class='tsort=="new"?"active":""'>最新</div>
        <div class='hot' @click='toggltSortType($event)' :class='tsort=="hot"?"active":""'>最热</div>
      </div>
      <div v-if="result.length>0">

      </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      hot: false,
      tech_type: 0,
      tsort: 'new',
      result: []
    }
  },
  props: {
    targetsTech: {
      type: Array,
      default: function () {
        return []
      }
    },
    targets: {
      type: Array,
      default: function () {
        return []
      }
    },
    list: {
      type: Object,
      default: function () {
        return {}
      }
    },
    sort: {
      type: Boolean,
      default: false
    },
    comment: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    toggltSortType (event) {
      this.tsort = event.target.classList[0]
      // this.reLoadList()
    },
    loadList (e, index) {
      // if (e.target.className.indexOf('el-tag--info') >= 0) {
      this.tech_type = index
      // }
    }
  }
}
</script>

<style scoped lang="stylus">
@import '../../common/css/variable.styl';
  .active
    color red
  .list{
    padding:5px 0;
    border-bottom: 1px solid #ddd;
  &>p{
     color:#909090;
     font-size:12px;
   }
  .content{
    padding:15px 0;
  h3{
    color:#2E3135;
    font-size:20px;
  }
  div{
    font-size:14px;
    line-height: 26px;
  }
  }
  }
</style>
