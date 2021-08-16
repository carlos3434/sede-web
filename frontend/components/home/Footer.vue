<script>
/**
 * Home Footer component
 */
export default {}
</script>

<template>
  <div class="footer-container">
    <footer class="footer-home">
      <div class="container">
        <div class="row">
          <div class="col-md-6 footer-info">
            <div class="row">
              <div class="col-sm-12 col-lg-4">
                <h1 class="footer-home-title text-center text-md-start">CENEPRED {{ new Date().getFullYear() }}</h1>
              </div>
              <div class="col-sm-12 col-lg-4">
                <h2>Dirección</h2>
                <p>Av. Del Parque Norte 313 - 319 <br />San Isidro Lima - Perú</p>
              </div>
              <div class="col-sm-12 col-lg-4">
                <h2>Central Telefónica:</h2>
                <p>(051) 2013550</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 footer-social-icons">
            <div class="float-start float-md-end">
              <a target="_blank" href="https://www.facebook.com/cenepred/timeline/"
                ><i class="fab fa-facebook-square"></i
              ></a>
              <a target="_blank" href="https://twitter.com/CENEPRED"><i class="fab fa-twitter-square"></i></a>
              <a target="_blank" href="https://www.youtube.com/channel/UCw9I7jPR0NLMqT2DmDGgMeQ"
                ><i class="fab fa-youtube-square"></i
              ></a>
              <a target="_blank" href="https://www.linkedin.com/company/cenepred/"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style lang="scss">
body {
  height: 100%;
  min-height: 100%;
}
</style>

<style lang="scss" scoped>
.footer-container::v-deep {
  .footer-info {
    h2 {
      color: #fff;
      font-size: 1.2rem;
      font-weight: 600;
    }
  }
  .footer-home {
    background-color: #00839b;
    clear: both;
    box-shadow: 0 0px 4px rgb(15 34 58 / 12%);
    color: #fff;
    padding: 20px calc(1.25rem / 2);
  }
  .footer-home-title {
    font-size: 1.2rem;
    font-weight: 600;
    line-height: 1.5;
    color: #fff;
  }
  .footer-social-icons {
    a {
      color: #fff;
      &:hover {
        color: #fff;
      }
      i {
        font-size: 1.6em;
        margin: 0 0 0 5px;
      }
    }
  }
}
</style>
