export default function ({ $auth, redirect, $gates, $roles }) {
  if (!$gates.hasRole($roles.US_ADMIN)) {
    redirect('/admin/dashboard')
  }
}
