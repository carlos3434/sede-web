<script>
export default {
  layout: 'vertical',
  async asyncData({ params, redirect }) {
    if (!params.id) redirect(`/admin/cenepred/seleccion/calificacion`)

    let id = params.id

    return { id }
  },
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Calificación',
      items: [{ text: 'Admin' }, { text: 'Selección verificadores AdHoc' }, { text: 'Calificación', active: true }],
      id: null,
      item: {},
      loading: true,
      visibleFormaciones: true,
      visibleCapacitaciones: false,
      visibleExpgeneral: false,
      visibleExpinspector: false,
      visibleVerificaciones: false
    }
  },
  mounted() {
    this.getAdhocData()
  },
  computed: {
    adhoc_fullname() {
      return (
        this.item.usuario_nombres + ' ' + this.item.usuario_apellido_paterno + ' ' + this.item.usuario_apellido_materno
      )
    },
    puntaje_formaciones() {
      let x = this.item.formaciones
      return (x.length && x[0].puntaje) || 0
    },
    puntaje_capacitaciones() {
      let x = this.item.capacitaciones
      return (x.length && x[0].puntaje) || 0
    },
    puntaje_experiencias_generales() {
      let x = this.item.experiencias_generales
      return (x.length && x[0].puntaje) || 0
    },
    puntaje_experiencias_inspector() {
      let x = this.item.experiencias_inspector
      return (x.length && x[0].puntaje) || 0
    },
    puntaje_verificaciones_realizadas() {
      let x = this.item.verificaciones_realizadas
      return (x.length && x[0].puntaje) || 0
    },
    esta_calificado() {
      return this.item.esta_calificado || false
    },
    collapseAll() {
      let c
      c = this.visibleFormaciones && this.visibleCapacitaciones
      c = c && this.visibleExpgeneral && this.visibleExpinspector
      c = c && this.visibleVerificaciones
      return c
    }
  },
  methods: {
    requestCalificarItem() {
      this.$router.push(`/admin/cenepred/seleccion/calificacion/${this.id}/calificar`)
    },
    expandAll() {
      let e = !this.collapseAll
      this.visibleFormaciones = e
      this.visibleCapacitaciones = e
      this.visibleExpgeneral = e
      this.visibleExpinspector = e
      this.visibleVerificaciones = e
    },
    async getAdhocData() {
      let apiUrl = '/calificacion/' + this.id

      await this.$axios
        .get(apiUrl)
        .then((res) => {
          if (!res) this.$router.push(`/admin/cenepred/seleccion/calificacion`)

          this.item = res.data.data
        })
        .finally(() => {
          this.loading = false
        })
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4" v-if="loading">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <div class="spinner-border text-secondary" role="status">
                <span class="sr-only">Cargando...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mx-lg-4" v-else>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Convocatoria:</label>
                  <p class="text-muted m-0">{{ item.convocatoria_nombre }}</p>
                </div>
                <div class="mb-3">
                  <label class="form-label">Postulante:</label>
                  <p class="text-muted m-0">
                    {{ adhoc_fullname }}
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Sede Registral:</label>
                  <p class="text-muted m-0">{{ item.sede_registral_nombre }}</p>
                </div>
                <div class="mb-3">
                  <label class="form-label">Puntaje Total:</label>
                  <p class="text-info m-0">{{ item.puntaje_total }} puntos</p>
                </div>
              </div>
            </div>
            <div class="button-items">
              <b-button variant="success" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <template v-if="!collapseAll">
                <b-button variant="light" @click="expandAll"> <i class="fas fa-eye"></i> Expandir todo</b-button>
              </template>
              <template v-else>
                <b-button variant="light" @click="expandAll"> <i class="fas fa-eye-slash"></i> Contraer todo</b-button>
              </template>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="me-2">
              <div class="avatar-xs">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">01</div>
              </div>
            </div>
            <h2 class="card-title">
              Formaciones
              <span class="text-subsection text-info">
                Puntaje: <b>{{ puntaje_formaciones }} puntos</b>
              </span>
            </h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-1>
                <template v-if="visibleFormaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-1" visible v-model="visibleFormaciones">
            <div class="card-body">
              <CenepredSeleccionCalificacionesTablaFormaciones
                :items="item.formaciones"
              ></CenepredSeleccionCalificacionesTablaFormaciones>
            </div>
          </b-collapse>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="me-2">
              <div class="avatar-xs">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">02</div>
              </div>
            </div>
            <h2 class="card-title">
              Capacitaciones
              <span class="text-subsection text-info">
                Puntaje: <b>{{ puntaje_capacitaciones }} puntos</b>
              </span>
            </h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-2>
                <template v-if="visibleCapacitaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-2" visible v-model="visibleCapacitaciones">
            <div class="card-body">
              <CenepredSeleccionCalificacionesTablaCapacitaciones
                :items="item.capacitaciones"
              ></CenepredSeleccionCalificacionesTablaCapacitaciones>
            </div>
          </b-collapse>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="me-2">
              <div class="avatar-xs">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">03</div>
              </div>
            </div>
            <h2 class="card-title">
              Experiencia General
              <span class="text-subsection text-info">
                Puntaje: <b>{{ puntaje_experiencias_generales }} puntos</b>
              </span>
            </h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-3>
                <template v-if="visibleExpgeneral"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-3" visible v-model="visibleExpgeneral">
            <div class="card-body">
              <CenepredSeleccionCalificacionesTablaExpgeneral
                :items="item.experiencias_generales"
              ></CenepredSeleccionCalificacionesTablaExpgeneral>
            </div>
          </b-collapse>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="me-2">
              <div class="avatar-xs">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">04</div>
              </div>
            </div>
            <h2 class="card-title">
              Experiencia como Inspector
              <span class="text-subsection text-info">
                Puntaje: <b>{{ puntaje_experiencias_inspector }} puntos</b>
              </span>
            </h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-4>
                <template v-if="visibleExpinspector"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-4" visible v-model="visibleExpinspector">
            <div class="card-body">
              <CenepredSeleccionCalificacionesTablaExpinspector
                :items="item.experiencias_inspector"
              ></CenepredSeleccionCalificacionesTablaExpinspector>
            </div>
          </b-collapse>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="me-2">
              <div class="avatar-xs">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">05</div>
              </div>
            </div>
            <h2 class="card-title">
              Verificaciones Realizadas
              <span class="text-subsection text-info">
                Puntaje: <b>{{ puntaje_verificaciones_realizadas }} puntos</b>
              </span>
            </h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem" v-if="!esta_calificado">
                <i class="far fa-star"></i> Calificar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-5>
                <template v-if="visibleVerificaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-5" visible v-model="visibleVerificaciones">
            <div class="card-body">
              <CenepredSeleccionCalificacionesTablaVerificaciones
                :items="item.verificaciones_realizadas"
              ></CenepredSeleccionCalificacionesTablaVerificaciones>
            </div>
          </b-collapse>
        </div>
      </div>
    </div>
  </div>
</template>
