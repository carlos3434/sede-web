export default function ({ $auth, redirect, store }) {
  let user = $auth.$state.user

  if (user) redirect('/admin')
}
