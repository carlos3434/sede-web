export default (context, inject) => {
  // Funcion para descarga de archivos en general, con URL absoluta
  const downloadUrl = (url, title, ext) => {
    let extencion = ext || ''

    context
      .$axios({
        url: url,
        method: 'GET',
        responseType: 'blob'
      })
      .then((response) => {
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(response.data)
        link.download = title + extencion
        link.click()
      })
      .catch((e) => console.log('error occured'))
  }

  // Funcion para la descarga de archivos bajo la URL ".../file/..."
  const downloadFile = (filePartialUrl) => {
    let url = context.$config.filebaseurl + filePartialUrl
    let filename = filePartialUrl.replace('/', '-')
    downloadUrl(url, filename)
  }

  inject('downloadUrl', downloadUrl)
  inject('downloadFile', downloadFile)
}
