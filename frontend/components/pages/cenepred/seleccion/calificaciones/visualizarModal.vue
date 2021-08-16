<script>
export default {
  props: {
    id: {
      type: String
    }
  },
  async fetch() {
    try {
      const data = await this.$axios.get('/calificacion/' + this.id).then((res) => res)
      let d = data.data.data
      this.capacitaciones = d.capacitaciones
      this.exp_generales = d.experiencias_generales
      this.exp_inspector = d.experiencias_inspector
      this.formaciones = d.formaciones
      this.verificaciones = d.verificaciones_realizadas
    } catch (error) {}
  },
  fetchOnServer: false,
  data() {
    return {
      modalId: 'modal-vizualizar',
      openModalEvent: 'open-vizualizar-modal',
      title: '',
      visibleFormaciones: false,
      visibleCapacitaciones: false,
      visibleExpgeneral: false,
      visibleExpinspector: false,
      visibleVerificaciones: false,
      capacitaciones: [],
      exp_generales: [],
      exp_inspector: [],
      formaciones: [],
      verificaciones: []
    }
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (tableName) => {
      this.showTable(tableName)
      this.showModal()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off(this.openModalEvent)
  },
  methods: {
    showModal() {
      this.$bvModal.show(this.modalId)
    },
    hideModal() {
      this.$bvModal.hide(this.modalId)
    },
    showTable(tableName) {
      switch (tableName) {
        case 'formacion':
          this.title = 'Formaciones'
          this.resetVisibleTables()
          this.visibleFormaciones = true
          break
        case 'capacitacion':
          this.title = 'Capacitaciones'
          this.resetVisibleTables()
          this.visibleCapacitaciones = true
          break
        case 'general':
          this.title = 'Experiencias Generales'
          this.resetVisibleTables()
          this.visibleExpgeneral = true
          break
        case 'inspector':
          this.title = 'Experiencias como Inspector'
          this.resetVisibleTables()
          this.visibleExpinspector = true
          break
        case 'verificacion':
          this.title = 'Verificaciones Realizadas'
          this.resetVisibleTables()
          this.visibleVerificaciones = true
          break
      }
    },
    resetVisibleTables() {
      this.visibleFormaciones = false
      this.visibleCapacitaciones = false
      this.visibleExpgeneral = false
      this.visibleExpinspector = false
      this.visibleVerificaciones = false
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="hideModal" size="xl" @hidden="hideModal">
      <div>
        <CenepredSeleccionCalificacionesTablaFormaciones
          :items="formaciones"
          v-if="visibleFormaciones"
        ></CenepredSeleccionCalificacionesTablaFormaciones>
        <CenepredSeleccionCalificacionesTablaCapacitaciones
          :items="capacitaciones"
          v-if="visibleCapacitaciones"
        ></CenepredSeleccionCalificacionesTablaCapacitaciones>
        <CenepredSeleccionCalificacionesTablaExpgeneral
          :items="exp_generales"
          v-if="visibleExpgeneral"
        ></CenepredSeleccionCalificacionesTablaExpgeneral>
        <CenepredSeleccionCalificacionesTablaExpinspector
          :items="exp_inspector"
          v-if="visibleExpinspector"
        ></CenepredSeleccionCalificacionesTablaExpinspector>
        <CenepredSeleccionCalificacionesTablaVerificaciones
          :items="verificaciones"
          v-if="visibleVerificaciones"
        ></CenepredSeleccionCalificacionesTablaVerificaciones>
      </div>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cerrar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-thumbs-up"></i> Ok
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
