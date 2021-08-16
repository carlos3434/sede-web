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
    let pageTitle = 'Listado de Reportes'

    return {
      title: pageTitle,
      items: [{ text: 'Admin' }, { text: 'Reportes' }, { text: pageTitle, active: true }],
      tableData: listReportes,
      sortBy: 'id',
      fields: [
        {
          label: '#',
          key: 'id',
          sortable: false,
          class: 'text-center'
        },
        {
          label: 'Reportes',
          key: 'nombre',
          sortable: false
        },
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
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
    <GeneralReporteFiltroModal></GeneralReporteFiltroModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de reportes</h2>
          </div>
          <div class="card-body">
            <div class="table-responsive mb-0">
              <b-table ref="table" responsive="sm" :items="tableData" :fields="fields" hover>
                <template v-slot:cell(opciones)="data">
                  <b-button size="sm" variant="outline-info" class="w-sm" @click="requestReporte(data.item)">
                    <i class="fas fa-download"></i> Descargar
                  </b-button>
                </template>
              </b-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
