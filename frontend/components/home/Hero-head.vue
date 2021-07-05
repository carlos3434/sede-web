<script>
/**
 * Hero head component
 */
export default {}
</script>

<template>
  <div>
    <b-container class="mt-3 mb-3">
      <div class="d-flex justify-content-between align-items-center">
        <div class="hero-logo-cenepred">
          <a href="https://cenepred.gob.pe/web/" target="_blank">
            <img src="~/assets/images/cenepred/logo_cenepred02.png" />
          </a>
        </div>
        <div class="hero-text-cenepred d-none d-md-block">
          <h1 class="title mensaje">"Promoviendo Cultura de Prevención"</h1>
        </div>
        <div class="hero-text-ministerio">
          <a href="https://www.gob.pe/mindef" target="_blank">
            <img src="~/assets/images/cenepred/mindef1.jpg" />
          </a>
        </div>
      </div>
    </b-container>
  </div>
</template>

<style>
.hero-logo-cenepred img {
  max-height: 100px;
}
.hero-text-cenepred h1 {
  font-family: 'acumin-pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  color: #00839b !important;
  font-style: italic;
  font-size: 2.2em;
}
.hero-text-ministerio img {
  max-height: 50px;
}
</style>
