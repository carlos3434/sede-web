<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Nosotros',
      items: [{ text: 'Útiles' }, { text: 'Nosotros', active: true }]
    }
  },
  middleware: 'authentication'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">¿Quiénes somos?</h4>
            <div class="row mt-5">
              <div class="col-xl-7">
                <p style="text-align: justify">
                  El Centro Nacional de Estimación, Prevención y Reducción del Riesgo de Desastres – CENEPRED es un
                  organismo público ejecutor que conforma el SINAGERD, responsable técnico de coordinar, facilitar y
                  supervisar la formulación e implementación de la Política Nacional y el Plan Nacional de Gestión del
                  Riesgo de Desastres, en los procesos de estimación, prevención y reducción del riesgo, así como de
                  reconstrucción. Propone y asesora al ente rector, así como a los distintos entes públicos y privados
                  que integran al SINAGERD sobre la política, lineamientos y mecanismos referidos a los procesos de
                  estimación, prevención y reducción de riesgo y reconstrucción.
                </p>
              </div>
              <div class="col-xl-4 col-sm-5 mx-auto">
                <div>
                  <img src="~/assets/images/faqs-img.png" alt="" class="img-fluid mx-auto d-block" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
