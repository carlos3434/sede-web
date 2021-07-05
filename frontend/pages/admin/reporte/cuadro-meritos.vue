<script>
import { listReportes } from './listReportes'

export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    return {
      title: 'Cuadro de Méritos',
      items: [{ text: 'Admin' }, { text: 'Curriculum Vitae' }, { text: 'Cuadro de Méritos', active: true }],
      tableData: listReportes,
      sortBy: 'id',
      fields: [
        {
          label: '#',
          key: 'id',
          sortable: false,
          visible: true
        },
        {
          label: 'Reportes',
          key: 'nombre',
          sortable: false,
          visible: true
        },
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
          visible: true,
          class: 'bs-option-col',
          thClass: 'bs-option-col-header'
        }
      ]
    }
  },
  created() {
    this.$nuxt.$on('refresh-table', () => {
      this.refreshTable()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off('refresh-table')
  },
  methods: {
    requestReporte(item) {
      this.$nuxt.$emit('open-reporte-modal', item)
    },
    refreshTable() {
      this.$refs.table.refresh()
    },
    getItems(ctx) {}
  },
  middleware: ['us-admin']
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <ReporteFiltroModal></ReporteFiltroModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de reportes</h2>
          </div>
          <div class="card-body">
            <!-- Table -->
            <div class="table-responsive mb-0">
              <b-table ref="table" responsive="sm" :items="tableData" :fields="fields" hover>
                <template v-slot:cell(opciones)="data">
                  <b-button size="sm" variant="outline-info" class="w-sm" @click="requestReporte(data.item)">
                    <i class="fas fa-download"></i> Descargar
                  </b-button>
                </template>
              </b-table>
            </div>
            <!-- End Table -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
