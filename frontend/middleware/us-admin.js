export default function ({ $auth, redirect, $gates, $roles }) {
  let user = $auth.$state.user
  if (!user) redirect('/usuario/login')
  if (!$gates.hasRole($roles.US_ADMIN)) redirect('/admin')
}
