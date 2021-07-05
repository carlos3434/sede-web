export default function ({ $auth, redirect, $gates, $roles }) {
  if (!$gates.hasRole($roles.US_ADMINISTRADO)) {
    redirect('/admin/dashboard')
  }
}
