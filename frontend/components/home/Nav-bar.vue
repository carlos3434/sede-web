<script>
/**
 * NavBar component
 */
export default {}
</script>

<template>
  <div>
    <b-navbar toggleable="sm" type="dark" variant="custom">
      <b-container>
        <b-navbar-brand>
          <!-- <nuxt-link to="/" class="navbar-brand">CENEPRED </nuxt-link> -->
        </b-navbar-brand>
        <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

        <b-collapse id="nav-text-collapse" is-nav right>
          <b-navbar-nav class="ml-auto mb-2 mb-sm-0 custom-navbar-nav">
            <b-nav-item active to="/usuario/login">
              <i aria-hidden="true" class="fas fa-sign-in-alt"></i>
              Inicio de sesión
            </b-nav-item>
            <b-nav-item active to="/usuario/registro">
              <i aria-hidden="true" class="fas fa-user-plus"></i>
              Registrarse
            </b-nav-item>
          </b-navbar-nav>
        </b-collapse>
      </b-container>
    </b-navbar>
  </div>
</template>

<style>
.bg-custom {
  background-color: #00839b;
}
.custom-navbar-nav {
  justify-content: flex-end;
  margin-left: auto;
}
</style>
