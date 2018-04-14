import Vue from 'vue'
import vuex from 'vuex'
import router from './../router'
Vue.use(vuex)

export default new vuex.Store({
  state: {
    navList: [
      {
        name: '首页',
        route: '/'
      },
      {
        name: '知识体系',
        route: 'knowledge'
      },
      {
        name: '活动中心',
        route: 'activity'
      },
      {
        name: '文章',
        route: 'articles'
      },
      {
        name: '写文章',
        route: 'write'
      },
      {
        name: '未读消息',
        route: 'user'
      }
    ],
    bannerList: [
      {
        imgUrl: 'banner1.jpg'
      },
      {
        imgUrl: 'banner2.jpg'
      },
      {
        imgUrl: 'banner3.jpg'
      }
    ],
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
    activeName: 'html',
    userNav: [
      {
        title: '我的信息',
        route: 'userInfo'
      },
      {
        title: '修改密码',
        route: 'resetpwd'
      },
      {
        title: '我的帖子',
        route: 'mynote'
      },
      {
        title: '我的收藏',
        route: 'mycollection'
      },
      {
        title: '我的消息',
        route: 'myInfo'
      },
      {
        title: '我的任务',
        route: 'mytask'
      }
    ]
  },
  mutations: {
    jump (state, path) {
      router.push(path)
    }
  }
})
