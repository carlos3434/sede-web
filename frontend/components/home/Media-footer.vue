<script>
/**
 * Home Footer component
 */
export default {}
</script>

<template>
  <section class="media-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <section class="topfooter-title">
            <h1>Verificadores Ad Hoc</h1>
          </section>
        </div>
        <div class="col-md-6 col-sm-8">
          <section class="topfooter-about-us">
            <h1>Acerca de nosotros</h1>
            <p>
              El servicio de Verificadores Ad Hoc consiste en cautelar la seguridad de edificaciones de más de cinco
              pisos, los centros y galerías comerciales, los campos feriales, los establecimientos de hospedaje y los
              edificios de concentración masiva de público.
            </p>
          </section>
        </div>
        <div class="col-md-4 col-sm-8">
          <section class="topfooter-importante">
            <h1>Importante</h1>
            <ul>
              <li>
                <a href="#"> Protocolo para la prestación del servicio de verificaciones Ad Hoc. </a>
              </li>
              <li>
                <a href="#"> Convocatoria para la selección y acreditación de verificadores Ad hoc. </a>
              </li>
            </ul>
          </section>
        </div>
        <div class="col-md-2 col-sm-8">
          <section class="topfooter-registro">
            <h1>Regístrate</h1>
            <b-button variant="outline-success" to="/usuario/registro"> Regístrate Aqui </b-button>
          </section>
        </div>
      </div>
    </div>
  </section>
</template>

<style>
.media-footer {
  margin: 30px 0 70px 0;
}
.topfooter-title {
  text-align: center;
  margin: 2.5rem;
}
.topfooter-title h1 {
  font-size: 2.4rem;
  font-weight: 400;
}
.topfooter-about-us h1 {
  font-size: 2rem;
  font-weight: 400;
  margin-bottom: 1rem;
}
.topfooter-about-us p {
  color: #232323;
  font-weight: 300;
  font-size: 1.4rem;
  text-align: left;
}
.topfooter-importante h1 {
  font-size: 1.5rem;
  font-weight: 400;
  margin-bottom: 1rem;
}
.topfooter-registro h1 {
  font-size: 1.5rem;
  font-weight: 400;
  margin-bottom: 1rem;
}
</style>
