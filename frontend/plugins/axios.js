import Vue from 'vue'

export default function ({ $axios, $notify, redirect }) {
  $axios.onRequest((config) => {
    // console.log('Making request to ' + config.url)
  })

  $axios.onError((error) => {
    const code = parseInt(error.response && error.response.status)
    let msg = ''

    if (error && error.response) {
      switch (code) {
        case 400:
          msg = 'Hubo algún problema al procesar su solicitud'
          break
        case 401:
          msg = 'Acción, no autorizado o no está permitido'
          break
        case 403:
          msg = 'Lo sentimos, no está permitido para esta acción'
          break
        case 404:
          msg = 'Ruta no definida'
          break
        case 405:
          msg = 'Acción no permitido'
          break
        case 422:
          msg = 'Datos invalidos, modificar los campos e intentelo nuevamente.'
          //   error.response.data.errors
          //   error.response.data.message
          break
        case 500:
          msg = 'Error del servidor, inténtelo de nuevo más tarde'
          break
        default:
          msg = 'Hubo un problema con su solicitud. Vuelva a intentarlo más tarde.'
          break
      }
    } else if (error && error.request) {
      msg = 'Hay problemas con nuestros servidores, inténtelo de nuevo más tarde'
    } else {
      msg = 'Hubo un problema con su solicitud. Vuelva a intentarlo más tarde.'
    }

    Vue.notify({ type: 'danger', text: msg })

    if (code !== 422) return Promise.resolve(false)
  })
}
