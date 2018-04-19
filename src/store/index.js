import Vue from 'vue'
import vuex from 'vuex'
import router from './../router'
Vue.use(vuex)

export default new vuex.Store({
  state: {
    articleList: [
      {
        title: '热门文章',
        name: 'article',
        content: [
          {
            title: '测试文章',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          }
        ]
      },
      {
        title: 'html',
        name: 'html',
        content: [
          {
            title: '测试文章html',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章html',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章html',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          }
        ]
      },
      {
        title: 'css',
        name: 'css',
        content: [
          {
            title: '测试文章css',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章css',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          },
          {
            title: '测试文章css',
            class: '测试',
            comment: 16,
            like: 2,
            publishDate: '2小时前'
          }
        ]
      }
    ],
    activeName: 'html'
  },
  mutations: {
    jump (state, path) {
      router.push(path)
    }
  }
})
