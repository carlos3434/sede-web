<script>
/**
 * Home Footer component
 */
export default {}
</script>

<template>
  <div>
    <footer class="footer-home">
      <div class="container">
        <div class="d-flex justify-content-between">
          <div>
            <h1 class="footer-home-title">CENEPRED {{ new Date().getFullYear() }}</h1>
          </div>
          <div>
            <i class="fab fa-facebook-square"></i>
            <i class="fab fa-twitter-square"></i>
            <i class="fab fa-google-plus-square"></i>
            <i class="fab fa-linkedin"></i>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style>
body {
  height: 100%;
  min-height: 100%;
}
.footer-home {
  background-color: #00839b;
  clear: both;
  height: 60px;
  box-shadow: 0 0px 4px rgb(15 34 58 / 12%);
  color: #fff;
  padding: 20px calc(1.25rem / 2);
}
.footer-home-title {
  font-size: 1em;
  font-weight: 400;
  line-height: 1.5;
  color: #fff;
}
</style>
