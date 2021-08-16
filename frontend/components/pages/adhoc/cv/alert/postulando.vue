<script>
export default {
  props: {
    seccion: {
      type: String,
      default: ''
    }
  }
}
</script>

<template>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row" v-if="$auth.user.esta_postulando && !$auth.user.esta_acreditado">
          <div class="col-md-12">
            <b-alert variant="warning" show class="m-0">
              <p class="m-0">
                <b> Ud. se encuentra postulando a una convocatoria. </b>
                No puede modificar su información en este momento.
              </p>
            </b-alert>
          </div>
        </div>
        <div class="row" v-else-if="$auth.user.esta_postulando && $auth.user.esta_acreditado">
          <div class="col-md-12">
            <b-alert variant="success" show class="m-0">
              <p class="m-0">
                <b> Ud. esta acreditado. </b>
                No puede modificar su información en este momento.
              </p>
            </b-alert>
          </div>
        </div>
        <div class="row" v-else>
          <div class="col-md-12" v-if="seccion">
            <b-alert variant="warning" show class="m-0">
              <p class="m-0">
                En esta sección Ud. puede <b>Agregar</b>, <b>Editar</b> o <b>Eliminar</b> la información relacionada a
                {{ seccion }}.
              </p>
            </b-alert>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
