<script>
/**
 * Footer component
 */
export default {}
</script>

<template>
  <div>
    <footer class="footer">
      <div class="container-fluid">
        <div class="row mx-lg-4">
          <div class="col-sm-6">{{ new Date().getFullYear() }} © CENEPRED</div>
          <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
              Hecho con
              <i class="mdi mdi-heart text-danger"></i> por
              <a href="https://themesbrand.com/" target="_blank" class="text-reset">CENEPRED</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
