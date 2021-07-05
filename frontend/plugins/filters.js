import Vue from 'vue'

export default () => {
  Vue.filter('newFilter', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase()
  })
}
