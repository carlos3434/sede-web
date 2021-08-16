<script>
export default {
  layout: 'vertical',
  async asyncData({ params, $axios }) {
    const id = params.id
    const data = await $axios.get('/calificacion/' + id).then((res) => res.data)

    const capacitaciones = data.data.capacitaciones
    const exp_generales = data.data.experiencias_generales
    const exp_inspector = data.data.experiencias_inspector
    const formaciones = data.data.formaciones
    const verificaciones = data.data.verificaciones_realizadas

    return { id, formaciones, capacitaciones, exp_generales, exp_inspector, verificaciones }
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
      visibleFormaciones: true,
      visibleCapacitaciones: false,
      visibleExpgeneral: false,
      visibleExpinspector: false,
      visibleVerificaciones: false,
      collapseAll: false
    }
  },
  methods: {
    requestCalificarItem(item) {
      this.$router.push(`/admin/cenepred/seleccion/calificacion/${this.id}/calificar`)
    },
    expandAll() {
      this.collapseAll = !this.collapseAll
      this.visibleFormaciones = this.collapseAll
      this.visibleCapacitaciones = this.collapseAll
      this.visibleExpgeneral = this.collapseAll
      this.visibleExpinspector = this.collapseAll
      this.visibleVerificaciones = this.collapseAll
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="button-items">
              <b-button variant="success" @click="requestCalificarItem"><i class="far fa-star"></i> Calificar</b-button>
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
            <h2 class="card-title">Formaciones</h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem">
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
              <SeleccionCalificacionesTablaFormaciones :items="formaciones"></SeleccionCalificacionesTablaFormaciones>
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
            <h2 class="card-title">Capacitaciones</h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem">
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
              <SeleccionCalificacionesTablaCapacitaciones
                :items="capacitaciones"
              ></SeleccionCalificacionesTablaCapacitaciones>
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
            <h2 class="card-title">Experiencia General</h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem">
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
              <SeleccionCalificacionesTablaExpgeneral :items="exp_generales"></SeleccionCalificacionesTablaExpgeneral>
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
            <h2 class="card-title">Experiencia como Inspector</h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem">
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
              <SeleccionCalificacionesTablaExpinspector
                :items="exp_inspector"
              ></SeleccionCalificacionesTablaExpinspector>
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
            <h2 class="card-title">Verificaciones Realizadas</h2>
            <div class="card-options">
              <b-button size="sm" variant="success" class="w-sm" @click="requestCalificarItem">
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
              <SeleccionCalificacionesTablaVerificaciones
                :items="verificaciones"
              ></SeleccionCalificacionesTablaVerificaciones>
            </div>
          </b-collapse>
        </div>
      </div>
    </div>
  </div>
</template>
