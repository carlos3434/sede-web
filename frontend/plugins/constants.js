export default ({ app }, inject) => {
  const SUPER_ADMIN = 'SUPER_ADMIN'
  const US_ADMIN = 'ADMINISTRADOR'
  const US_CENEPRED = 'USUARIO_CENEPRED'
  const US_ADHOC = 'USUARIO_ADHOC'
  const US_ADMINISTRADO = 'USUARIO_ADMINISTRADO'

  let constants = {
    SUPER_ADMIN,
    US_ADMIN,
    US_CENEPRED,
    US_ADHOC,
    US_ADMINISTRADO
  }

  inject('roles', constants)
}
