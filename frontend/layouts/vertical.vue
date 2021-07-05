<script>
import { mapState } from 'vuex'

/**
 * Vertical layout
 */
export default {
  name: 'vertical',
  created() {
    document.body.removeAttribute('data-layout')
    document.body.removeAttribute('data-topbar')
  },
  mounted() {
    document.body.classList.remove('authentication-bg')
    document.body.classList.add('admin-bg')
  },
  methods: {
    toggleRightSidebar() {
      document.body.classList.toggle('right-bar-enabled')
    },
    hideRightSidebar() {
      document.body.classList.remove('right-bar-enabled')
    },
    toggleMenu() {
      document.body.classList.toggle('sidebar-enable')

      if (window.screen.width >= 992) {
        // eslint-disable-next-line no-unused-vars
        this.$router.afterEach((routeTo, routeFrom) => {
          document.body.classList.remove('sidebar-enable')
          document.body.classList.remove('vertical-collpsed')
        })
        document.body.classList.toggle('vertical-collpsed')
      } else {
        // eslint-disable-next-line no-unused-vars
        this.$router.afterEach((routeTo, routeFrom) => {
          document.body.classList.remove('sidebar-enable')
        })
        document.body.classList.remove('vertical-collpsed')
      }
      this.isMenuCondensed = !this.isMenuCondensed
    }
  },
  data() {
    return {}
  },
  computed: mapState(['layout'])
}
</script>

<template>
  <!-- Begin page -->
  <div id="layout-wrapper">
    <AdminNotification />
    <AdminTopbar />
    <AdminSidebar :type="layout.leftSidebarType" :width="layout.layoutWidth" />
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <Nuxt />
        </div>
      </div>
      <!-- end Page-content -->
      <AdminFooter />
    </div>
    <!-- end main content-->
    <AdminRightSidebar />
  </div>
  <!-- end layout-wrapper -->
</template>
<style lang="scss">
.admin-bg {
  background: #f0f3f8;
}
</style>
