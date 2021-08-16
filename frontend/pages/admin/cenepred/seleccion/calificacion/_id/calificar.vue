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
      options: {},
      loading: true,
      visibleFormaciones: true,
      visibleCapacitaciones: true,
      visibleExpgeneral: true,
      visibleExpinspector: true,
      visibleVerificaciones: true,
      fields: [
        {
          label: 'Categoría',
          key: 'nombre'
        },
        {
          label: 'Selección',
          key: 'puntaje',
          class: 'bs-date-col'
        }
      ],
      puntajes: [],
      initialPuntaje: { id: null, categoria_id: null, puntaje: 0 },
      formacionSelected: { item_id: null, categoria_id: null, puntaje: 0 },
      capacitacionSelected: { item_id: null, categoria_id: null, puntaje: 0 },
      expgeneralSelected: { item_id: null, categoria_id: null, puntaje: 0 },
      expinspectorSelected: { item_id: null, categoria_id: null, puntaje: 0 },
      verificacionesSelected: { item_id: null, categoria_id: null, puntaje: 0 }
    }
  },
  mounted() {
    this.getAdhocData()
    this.loadOptions()
  },
  watch: {
    'formacionSelected.item_id': function (val) {
      let { element, index } = this.findSelectedRow(this.options.formaciones, val)
      this.formacionSelected = element
      this.$refs.formacionTable.selectRow(index)
    },
    'capacitacionSelected.item_id': function (val) {
      let { element, index } = this.findSelectedRow(this.options.capacitaciones, val)
      this.capacitacionSelected = element
      this.$refs.capacitacionesTable.selectRow(index)
    },
    'expgeneralSelected.item_id': function (val) {
      let { element, index } = this.findSelectedRow(this.options.experiencias_generales, val)
      this.expgeneralSelected = element
      this.$refs.expgeneralTable.selectRow(index)
    },
    'expinspectorSelected.item_id': function (val) {
      let { element, index } = this.findSelectedRow(this.options.experiencias_inspector, val)
      this.expinspectorSelected = element
      this.$refs.expinspectorTable.selectRow(index)
    },
    'verificacionesSelected.item_id': function (val) {
      let { element, index } = this.findSelectedRow(this.options.verificaciones_realizadas, val)
      this.verificacionesSelected = element
      this.$refs.verificacionesTable.selectRow(index)
    }
  },
  computed: {
    adhoc_fullname() {
      return (
        this.item.usuario_nombres + ' ' + this.item.usuario_apellido_paterno + ' ' + this.item.usuario_apellido_materno
      )
    },
    puntaje_total() {
      let sum = 0
      sum += this.puntaje_formaciones
      sum += this.puntaje_capacitaciones
      sum += this.puntaje_experiencias_generales
      sum += this.puntaje_experiencias_inspector
      sum += this.puntaje_verificaciones_realizadas
      return sum
    },
    puntaje_formaciones() {
      return 1 * this.formacionSelected.puntaje
    },
    puntaje_capacitaciones() {
      return 1 * this.capacitacionSelected.puntaje
    },
    puntaje_experiencias_generales() {
      return 1 * this.expgeneralSelected.puntaje
    },
    puntaje_experiencias_inspector() {
      return 1 * this.expinspectorSelected.puntaje
    },
    puntaje_verificaciones_realizadas() {
      return 1 * this.verificacionesSelected.puntaje
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
    findSelectedRow(list, element_id) {
      let e = list.find((i) => i.id === element_id)
      let index = list.indexOf(e)
      let { id, categoria_id, puntaje } = e || this.initialPuntaje
      let element = { item_id: id, categoria_id: categoria_id, puntaje: puntaje }
      return { element: element, index: index }
    },
    expandAll() {
      let e = !this.collapseAll
      this.visibleFormaciones = e
      this.visibleCapacitaciones = e
      this.visibleExpgeneral = e
      this.visibleExpinspector = e
      this.visibleVerificaciones = e
    },
    rowSelected(rows) {
      let { id, categoria_id, puntaje } = (rows.length && rows[0]) || this.initialPuntaje
      return { item_id: id, categoria_id: categoria_id, puntaje: puntaje }
    },
    onFormacionRowSelected(rows) {
      this.formacionSelected = this.rowSelected(rows)
    },
    onCapacitacionRowSelected(rows) {
      this.capacitacionSelected = this.rowSelected(rows)
    },
    onExpgeneralRowSelected(rows) {
      this.expgeneralSelected = this.rowSelected(rows)
    },
    onExpinspectorRowSelected(rows) {
      this.expinspectorSelected = this.rowSelected(rows)
    },
    onVerficicacionesRowSelected(rows) {
      this.verificacionesSelected = this.rowSelected(rows)
    },
    visualizarTabla(tableName) {
      this.$nuxt.$emit('open-vizualizar-modal', tableName)
    },
    sendCalificacion() {
      this.puntajes = []
      this.puntajes.push(this.formacionSelected)
      this.puntajes.push(this.capacitacionSelected)
      this.puntajes.push(this.expgeneralSelected)
      this.puntajes.push(this.expinspectorSelected)
      this.puntajes.push(this.verificacionesSelected)

      // SI encontramos alguna seccion sin marcar
      let isInvalid = this.puntajes.some((i) => i.item_id == null)

      if (isInvalid) {
        this.$notify({ type: 'danger', text: 'Por favor, es necesario seleccionar una opción por cada categoría.' })
        return
      }

      let data = new FormData()
      data.append('calificacion_id', this.id)

      for (let key in this.puntajes) {
        let { item_id, categoria_id } = this.puntajes[key]

        if (item_id != null && categoria_id != null) {
          data.append('puntajes[' + key + '][categoria_id]', categoria_id)
          data.append('puntajes[' + key + '][item_id]', item_id)
        }
      }

      this.$axios
        .post('/puntaje', data)
        .then((res) => {
          if (res) {
            this.$notify({ type: 'success', text: 'Calificación enviado correctamente' })
          } else {
            this.$notify({ type: 'danger', text: 'Por favor, es necesario seleccionar una opción por cada categoría.' })
          }
        })
        .finally(() => {
          this.$router.push('/admin/cenepred/seleccion/calificacion')
        })
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
    },
    async loadOptions() {
      await this.$axios.get('/listasParaPuntaje').then((res) => {
        this.options = res.data
      })
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <CenepredSeleccionCalificacionesVisualizarModal :id="id"></CenepredSeleccionCalificacionesVisualizarModal>

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
                  <p class="text-info m-0">{{ puntaje_total }} puntos</p>
                </div>
              </div>
            </div>
            <div class="button-items">
              <b-button variant="primary" @click="sendCalificacion">
                <i class="fas fa-paper-plane"></i> Enviar Calificación
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
              <b-button size="sm" variant="info" class="w-sm" @click="visualizarTabla('formacion')">
                <i class="far fa-eye"></i> Visualizar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-1>
                <template v-if="visibleFormaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-1" visible v-model="visibleFormaciones">
            <div class="card-body">
              <b-table
                hover
                :items="options.formaciones"
                :fields="fields"
                selectable
                ref="formacionTable"
                @row-selected="onFormacionRowSelected"
                select-mode="single"
              >
                <template v-slot:cell(puntaje)="data">
                  <b-form-radio
                    v-model="formacionSelected.item_id"
                    name="formacion-radios"
                    :value="data.item.id"
                  ></b-form-radio>
                </template>
              </b-table>
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
              <b-button size="sm" variant="info" class="w-sm" @click="visualizarTabla('capacitacion')">
                <i class="far fa-eye"></i> Visualizar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-2>
                <template v-if="visibleCapacitaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-2" visible v-model="visibleCapacitaciones">
            <div class="card-body">
              <b-table
                hover
                :items="options.capacitaciones"
                :fields="fields"
                selectable
                ref="capacitacionesTable"
                @row-selected="onCapacitacionRowSelected"
                select-mode="single"
              >
                <template v-slot:cell(puntaje)="data">
                  <b-form-radio
                    v-model="capacitacionSelected.item_id"
                    name="capacitacion-radios"
                    :value="data.item.id"
                  ></b-form-radio>
                </template>
              </b-table>
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
              <b-button size="sm" variant="info" class="w-sm" @click="visualizarTabla('general')">
                <i class="far fa-eye"></i> Visualizar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-3>
                <template v-if="visibleExpgeneral"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-3" visible v-model="visibleExpgeneral">
            <div class="card-body">
              <b-table
                hover
                :items="options.experiencias_generales"
                :fields="fields"
                selectable
                ref="expgeneralTable"
                @row-selected="onExpgeneralRowSelected"
                select-mode="single"
              >
                <template v-slot:cell(puntaje)="data">
                  <b-form-radio
                    v-model="expgeneralSelected.item_id"
                    name="expgeneral-radios"
                    :value="data.item.id"
                  ></b-form-radio>
                </template>
              </b-table>
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
              <b-button size="sm" variant="info" class="w-sm" @click="visualizarTabla('inspector')">
                <i class="far fa-eye"></i> Visualizar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-4>
                <template v-if="visibleExpinspector"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-4" visible v-model="visibleExpinspector">
            <div class="card-body">
              <b-table
                hover
                :items="options.experiencias_inspector"
                :fields="fields"
                selectable
                ref="expinspectorTable"
                @row-selected="onExpinspectorRowSelected"
                select-mode="single"
              >
                <template v-slot:cell(puntaje)="data">
                  <b-form-radio
                    v-model="expinspectorSelected.item_id"
                    name="expinspector-radios"
                    :value="data.item.id"
                  ></b-form-radio>
                </template>
              </b-table>
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
              <b-button size="sm" variant="info" class="w-sm" @click="visualizarTabla('verificacion')">
                <i class="far fa-eye"></i> Visualizar
              </b-button>
              <b-button size="sm" variant="outline-light" class="w-sm" data-toggle="collapse" v-b-toggle.collapse-5>
                <template v-if="visibleVerificaciones"> <i class="fas fa-chevron-up"></i> Contraer </template>
                <template v-else> <i class="fas fa-chevron-down"></i> Expandir </template>
              </b-button>
            </div>
          </div>
          <b-collapse id="collapse-5" visible v-model="visibleVerificaciones">
            <div class="card-body">
              <b-table
                hover
                :items="options.verificaciones_realizadas"
                :fields="fields"
                selectable
                ref="verificacionesTable"
                @row-selected="onVerficicacionesRowSelected"
                select-mode="single"
              >
                <template v-slot:cell(puntaje)="data">
                  <b-form-radio
                    v-model="verificacionesSelected.item_id"
                    name="verificaciones-radios"
                    :value="data.item.id"
                  ></b-form-radio>
                </template>
              </b-table>
            </div>
          </b-collapse>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="button-items">
              <b-button variant="primary" @click="sendCalificacion">
                <i class="fas fa-paper-plane"></i> Enviar Calificación
              </b-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.b-table-row-selected.table-active,
.b-table-row-selected.table-active:hover {
  background: #f0f3f8 !important;
  --bs-table-accent-bg: none;
}
.b-table-row-selected.table-active > td,
.b-table-row-selected.table-active:hover > td {
  background: none !important;
  --bs-table-accent-bg: none;
}
</style>
