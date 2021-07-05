export default function ({ $auth, redirect, store, $gates, $roles }) {
  let user = $auth.state.user

  if (!user) redirect('/usuario/login')
}
