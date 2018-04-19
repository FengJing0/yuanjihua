const state = {
  user: {},
  navList: [
    {name: '首页', route: '/index'},
    {name: '知识体系', route: '/knowledge'},
    {name: '活动中心', route: '/activity'},
    {name: '文章', route: '/articles'},
    {name: '写文章', route: '/write'},
    {name: '未读消息', route: '/user'}
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
  activeName: 'html'
}

export default state
