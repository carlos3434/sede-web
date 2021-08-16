<script>
/**
 * Topbar component
 */
export default {
  data() {
    return {}
  },
  mounted() {},
  methods: {
    /**
     * Toggle menu
     */
    toggleMenu() {
      this.$parent.toggleMenu()
    },
    initFullScreen() {
      document.body.classList.toggle('fullscreen-enable')
      if (
        !document.fullscreenElement &&
        /* alternative standard method */
        !document.mozFullScreenElement &&
        !document.webkitFullscreenElement
      ) {
        // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen()
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen()
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen()
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen()
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen()
        }
      }
    },
    logoutUser() {
      this.$auth.logout()
    }
  },
  filters: {
    capitalize: function (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  }
}
</script>

<template>
  <header id="page-topbar" class="page-topbar">
    <div class="navbar-header">
      <div class="d-flex">
        <button
          @click="toggleMenu"
          type="button"
          class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn"
          id="vertical-menu-btn"
        >
          <i class="fa fa-fw fa-bars"></i>
        </button>
      </div>

      <div class="d-flex">
        <b-dropdown
          variant="white"
          class="d-inline-block d-lg-none ms-2"
          toggle-class="header-item noti-icon"
          right
          menu-class="dropdown-menu-lg p-0 dropdown-menu-end"
        >
          <template v-slot:button-content>
            <i class="uil-search"></i>
          </template>
          <form class="p-3">
            <div class="form-group m-0">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  :placeholder="$t('navbar.search.text')"
                  aria-label="Recipient's username"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                    <i class="mdi mdi-magnify"></i>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </b-dropdown>

        <div class="dropdown d-none d-lg-inline-block ms-1">
          <button
            type="button"
            class="btn header-item noti-icon waves-effect"
            data-toggle="fullscreen"
            @click="initFullScreen"
          >
            <i class="uil-minus-path"></i>
          </button>
        </div>

        <b-dropdown
          variant="white"
          class="dropdown d-inline-block"
          toggle-class="header-item noti-icon"
          right
          menu-class="dropdown-menu-lg p-0 dropdown-menu-end"
        >
          <template v-slot:button-content>
            <i class="uil-bell"></i>
            <span class="badge bg-danger rounded-pill">0</span>
          </template>

          <div class="p-3">
            <div class="row align-items-center">
              <div class="col">
                <h5 class="m-0 font-size-16">
                  {{ $t('navbar.dropdown.notification.text') }}
                </h5>
              </div>
              <div class="col-auto">
                <a href="#!" class="small">{{ $t('navbar.dropdown.notification.subtext') }}</a>
              </div>
            </div>
          </div>
          <simplebar style="max-height: 230px" data-simplebar>
            <div class="notification-item">
              <div class="media">
                <div class="media-body">
                  <div class="font-size-12 text-muted">
                    <p>No tiene notificaciones.</p>
                  </div>
                </div>
              </div>
            </div>
          </simplebar>
        </b-dropdown>

        <b-dropdown
          class="d-inline-block ms-lg-2 me-lg-4"
          toggle-class="header-item"
          right
          variant="white"
          menu-class="dropdown-menu-end"
        >
          <template v-slot:button-content>
            <span style="font-size: 24px" class="d-sm-none d-md-block d-lg-block d-xl-block d-xxl-none">
              <i class="uil uil-user-circle"></i>
            </span>
            <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">
              Hola, {{ $auth.user ? $auth.user.nombres.toLowerCase() : '' | capitalize }}
            </span>
            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
          </template>

          <!-- item-->
          <nuxt-link class="dropdown-item" to="/admin?tabIndex=1">
            <i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i>
            <span class="align-middle">Perfil</span>
          </nuxt-link>
          <nuxt-link class="dropdown-item d-block" to="/admin?tabIndex=2">
            <i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i>
            <span class="align-middle">Cambiar contraseña</span>
          </nuxt-link>
          <a class="dropdown-item" @click="logoutUser" href="javascript: void(0);">
            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
            <span class="align-middle">Cerrar sesión</span>
          </a>
        </b-dropdown>
      </div>
    </div>
  </header>
</template>
<style lang="scss">
.page-topbar {
  background: #00839b !important;

  .app-search .form-control {
    color: #fff !important;
    &::placeholder {
      color: #fff !important;
    }
  }
  .noti-icon i {
    color: #fff !important;
  }
}
.app-search span {
  color: #fff !important;
}
.header-item {
  color: #fff !important;
}
</style>
