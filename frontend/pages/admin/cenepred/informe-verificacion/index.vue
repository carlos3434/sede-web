<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pageTitle = 'Informe de Verificación AdHoc'

    return {
      title: pageTitle,
      items: [{ text: 'Admin' }, { text: 'Notificaciones' }, { text: pageTitle, active: true }],
      urlTableData: '/notificaciones',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      sortDesc: true,
      sortBy: 'fecha_recepcion',
      fields: [
        {
          label: 'Nombre Comercial',
          key: 'nombre_comercial',
          sortable: true
        },
        {
          label: 'Administrado',
          key: 'administrado_full_name',
          sortable: true
        },
        {
          label: 'Nº de Hoja de Trámite',
          key: 'numero_hoja_tramite',
          sortable: true,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Informe de VAH',
          key: 'anexo10',
          sortable: false,
          class: 'bs-date-col'
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
    requestNotificar(item) {
      this.$nuxt.$emit('open-notificar-modal', item)
    },
    refreshTable() {
      this.$refs.table.refresh()
    },
    getItems(ctx) {
      let filters = this.filtersTable(ctx)
      let promise = this.$axios.get(this.urlTableData + filters)

      return promise
        .then((res) => {
          const items = res.data.data
          this.currentPage = res.data.meta.current_page
          this.totalRows = res.data.meta.total
          this.isBusy = false
          return items
        })
        .catch((error) => {
          this.isBusy = false
          return []
        })
    },
    filtersTable(ctx) {
      let sortText = ctx.sortDesc ? 'DESC' : 'ASC'
      let filters = `?page=${ctx.currentPage}`
      filters += `&per_page=${ctx.perPage}`
      filters += ctx.sortBy ? `&sortBy=${ctx.sortBy}` : ''
      filters += `&direction=${sortText}`

      return filters
    },
    checkStatusToNotify(estado) {
      return estado == 'INFORME ENTREGADO'
    },
    checkStatusNotified(estado) {
      return estado == 'ADMINISTRADO NOTIFICADO'
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <CenepredInformeVerificacionNotificarModal></CenepredInformeVerificacionNotificarModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning m-0" role="alert">
              Después de revisar el informe notifica al usuario administrado haciendo click en la opción
              <b>Notificar</b> ( <b><i class="fas fa-paper-plane"></i></b> )
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de expedientes entregados</h2>
          </div>
          <div class="card-body">
            <div class="row mt-4">
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                  <label class="d-inline-flex align-items-center">
                    Mostrar&nbsp;
                    <b-form-select v-model="perPage" size="sm" :options="pageOptions"></b-form-select>
                    &nbsp;registros
                  </label>
                </div>
              </div>
            </div>
            <!-- Table -->
            <div class="table-responsive mb-0">
              <b-table
                ref="table"
                responsive="sm"
                :busy.sync="isBusy"
                :items="tableData"
                :fields="fields"
                :per-page="perPage"
                :current-page="currentPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :filter="filter"
                :class="`table-nowrap`"
                striped
                show-empty
              >
                <template #empty="">
                  <p class="text-center">No hay registros para mostrar</p>
                </template>
                <template #cell(anexo10)="data">
                  <template v-if="data.value">
                    <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(data.value)">
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </template>
                  <template v-else>
                    <span>---</span>
                  </template>
                </template>
                <template v-slot:cell(opciones)="data">
                  <template v-if="checkStatusToNotify(data.item.estado_expediente_nombre)">
                    <b-button type="submit" size="sm" variant="outline-primary" @click="requestNotificar(data.item)">
                      <i class="fas fa-paper-plane"></i> Notificar
                    </b-button>
                  </template>
                  <template v-else-if="checkStatusNotified(data.item.estado_expediente_nombre)">
                    <span class="badge bg-soft-success font-size-12"><b>Notificado</b></span>
                  </template>
                  <template v-else> --- </template>
                </template>
              </b-table>
            </div>
            <div class="row">
              <div class="col">
                <div class="dataTables_paginate paging_simple_numbers float-end">
                  <ul class="pagination pagination-rounded mb-0">
                    <!-- pagination -->
                    <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage"></b-pagination>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
