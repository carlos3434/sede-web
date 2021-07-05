export default {
  // loading: "~/components/loading.vue",
  /*
   ** Nuxt rendering mode
   ** See https://nuxtjs.org/api/configuration-mode
   */
  ssr: false,
  /*
   ** Nuxt target
   ** See https://nuxtjs.org/api/configuration-target
   */
  target: 'static',
  /*
   ** Headers of the page
   ** See https://nuxtjs.org/api/configuration-head
   */
  head: {
    title: 'CENEPRED',
    htmlAttrs: {
      lang: 'es'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      {
        hid: 'description',
        name: 'description',
        content: ''
      }
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }]
  },
  router: {
    // linkExactActiveClass: 'active'
  },
  /*
   ** Global CSS
   */
  css: ['~/assets/scss/app.scss'],
  /*
   ** Plugins to load before mounting the App
   ** https://nuxtjs.org/guide/plugins
   */
  plugins: [
    // '~/plugins/fakeauth.js',
    // "~/plugins/fireauth.js",
    '~/plugins/i18n.js',
    '~/plugins/simplebar.js',
    '~/plugins/vue-click-outside.js',
    '~/plugins/vue-apexcharts.js',
    '~/plugins/vuelidate.js',
    '~/plugins/vue-slidebar.js',
    '~/plugins/vue-lightbox.js',
    '~/plugins/vue-chartist.js',
    '~/plugins/vue-mask.js',
    '~/plugins/vue-googlemap.js',
    '~/plugins/filters.js',
    '~/plugins/constants.js',
    '~/plugins/vue-gates.js',
    '~/plugins/vee-validate.js',
    '~/plugins/multiselect.js',
    { src: '~/plugins/notifications.server', mode: 'server' },
    { src: '~/plugins/notifications.client', mode: 'client' }
  ],
  /*
   ** Auto import components
   ** See https://nuxtjs.org/api/configuration-components
   */
  components: [
    '~/components',
    '~/components/pages/',
    { path: '~/components/home/', prefix: 'home' },
    { path: '~/components/admin/', prefix: 'admin' }
    // { path: '~/components/pages/', prefix: 'pages' }
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [],
  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://bootstrap-vue.js.org
    'bootstrap-vue/nuxt',
    // Doc: https://github.com/nuxt/content
    '@nuxt/content',
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    '@nuxtjs/moment'
  ],
  moment: {
    defaultLocale: 'es',
    locales: ['es'],
    defaultTimezone: 'America/Lima'
  },
  /*
   ** Content module configuration
   ** See https://content.nuxtjs.org/configuration
   */
  content: {},
  axios: {
    baseURL: process.env.VUE_APP_APIURL
  },
  auth: {
    strategies: {
      local: {
        token: {
          property: 'success.token',
          global: true,
          required: true,
          type: 'Bearer'
        },
        user: {
          property: 'success',
          autoFetch: true
        },
        endpoints: {
          login: { url: 'login', method: 'post' },
          logout: { url: 'logout', method: 'post' },
          user: { url: 'getUser', method: 'get' }
        }
      }
    }
  },
  /*
   ** Build configuration
   ** See https://nuxtjs.org/api/configuration-build/
   */
  build: {
    transpile: ['vee-validate/dist/rules'],
    extend(config, ctx) {}
  },
  publicRuntimeConfig: {
    // auth: process.env.VUE_APP_DEFAULT_AUTH,
    // apikey: process.env.VUE_APP_APIKEY,
    // authdomain: process.env.VUE_APP_AUTHDOMAIN,
    // projectid: process.env.VUE_APP_PROJECTId,
    // storgebucket: process.env.VUE_APP_STORAGEBUCKET,
    // message: process.env.VUE_APP_MESSAGINGSENDERID,
    // appid: process.env.VUE_APP_APPId,
    // measurement: process.env.VUE_APP_MEASUREMENTID,
    databaseurl: process.env.VUE_APP_DATABASEURL,
    filebaseurl: process.env.FILE_BASE_URL,
    reportebaseurl: process.env.REPORTE_FILE_BASE_URL
  },
  privateRuntimeConfig: {
    // apiSecret: process.env.API_SECRET
  }
}
