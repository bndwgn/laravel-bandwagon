const { description } = require('../../package')

module.exports = {
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#title
   */
  title: 'Laravel Bandwagon',
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#description
   */
  description: description,
  /**
   * Ref: https://vuepress.vuejs.org/guide/deploy.html#github-pages
   */
  base: '/',

  /**
   * Extra tags to be injected to the page HTML `<head>`
   *
   * ref：https://v1.vuepress.vuejs.org/config/#head
   */
  head: [
    ['meta', { name: 'theme-color', content: '#4E8FA4' }],
    ['meta', { name: 'apple-mobile-web-app-capable', content: 'yes' }],
    ['meta', { name: 'apple-mobile-web-app-status-bar-style', content: 'black' }]
  ],

  /**
   * Theme configuration, here is the default theme configuration for VuePress.
   *
   * ref：https://v1.vuepress.vuejs.org/theme/default-theme-config.html
   */
  themeConfig: {
    repo: '',
    editLinks: false,
    docsDir: '',
    editLinkText: '',
    lastUpdated: false,
    nav: [
      {
        text: 'Guide',
        link: '/guide/',
      },
      {
        text: 'Author',
        link: 'https://github.com/chasenyc'
      },
      {
        text: 'Source',
        link: 'https://github.com/bndwgn/laravel-bandwagon'
      }
    ],
    sidebar: {
      '/guide/': [
        {
          title: 'Guide',
          collapsable: false,
          children: [
            '',
            'getting-started',
            'configuration',
            'cleaning-up',
            'firing-events',
            'rendering'
          ]
        }
      ],
    }
  },

  /**
   * Apply plugins，ref：https://v1.vuepress.vuejs.org/zh/plugin/
   */
  plugins: [
    '@vuepress/plugin-back-to-top',
    '@vuepress/plugin-medium-zoom',
    [
      "vuepress-plugin-mailchimp",
      {
        title: "Updates",
        content: "Stay up to date on any changes, no spam, ever.",
        // You need to provide this plugin with your Mailchimp endpoint in order for it
        // to know where to save the email address. See more detail in Config section.
        endpoint: "https://laravelbandwagon.us7.list-manage.com/subscribe/post?u=0145e96878d00632811cbb77e&amp;id=22e4fcfd0f"
      }
    ]
  ]
}
