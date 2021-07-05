export default function ({ $auth, redirect, $gates, $roles }) {
  if (!$gates.hasRole($roles.US_CENEPRED)) {
    redirect('/admin/dashboard')
  }
}
