<script>
/**
 * Home Footer component
 */
export default {}
</script>

<template>
  <section>
    <div class="hero-banner d-flex align-items-center">
      <div class="container">
        <div class="hero-banner-text">
          <h1 class="title">Sede electrónica</h1>
          <h2 class="subtitle">
            Sistema para el servicio de verificaciones AD HOC y proceso administrativo sancionador PA
          </h2>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss">
.hero-banner .container {
  z-index: 1;
}
.hero-banner {
  margin: 0;
  margin-bottom: 20px;
  padding: 0.5em;
  min-height: 80vh;
  background-image: url(~assets/images/cenepred/fotos/asistencia-tecnica-cenepred.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
}
.hero-banner:before {
  content: '';
  width: 100%;
  min-height: 80vh;
  position: absolute;
  top: 0;
  left: 0;
  background: radial-gradient(circle closest-side, #838380, #00839b);
  opacity: 0.5;
}
.hero-banner-text {
  z-index: 1;
}
.hero-banner-text h1 {
  font-size: 5rem;
  font-weight: 600;
  color: #fff;
}
.hero-banner-text h2 {
  color: #fff;
  font-size: 2rem;
  font-weight: 400;
}

@media (max-width: 767.98px) {
  .hero-banner-text h1 {
    font-size: 4rem;
  }
}
</style>
