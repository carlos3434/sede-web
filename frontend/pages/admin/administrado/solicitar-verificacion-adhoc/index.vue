<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pagetitle = ' Solicitar Verificación AdHoc'
    let parentTitle = 'Registro de Expediente AdHoc'

    return {
      title: pagetitle,
      items: [{ text: 'Admin' }, { text: parentTitle }, { text: pagetitle, active: true }],
      urlTableData: '/expedienteadhoc',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      sortDesc: true,
      sortBy: 'created_at',
      fields: [
        {
          label: 'Nombre Comercial',
          key: 'nombre_comercial',
          sortable: true
        },
        {
          label: 'Documentos Cargados',
          key: 'estadisticas',
          sortable: false,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Nº de Hoja de Trámite',
          key: 'numero_hoja_tramite',
          sortable: true,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Fecha Solicitud',
          key: 'fecha_ingreso_ht',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Estado',
          key: 'estado_expediente_nombre',
          sortable: false,
          class: 'bs-nro-document-col'
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
  mounted() {
    this.$bvModal.show('modal-alert')

    this.$root.$on('bv::modal::hide', (bvEvent, modalId) => {
      if (modalId === 'modal-alert' && bvEvent.trigger !== 'ok') {
        bvEvent.preventDefault()
      }
    })
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
    requestSolicitar(item) {
      this.$nuxt.$emit('open-solicitar-verificacion-modal', item)
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
    handleAlertOk(bvModalEvt) {
      this.$bvModal.hide('modal-alert')
    }
  },
  middleware: 'us-administrado'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <AdministradoSolicitarVerificacionModal></AdministradoSolicitarVerificacionModal>

    <b-modal id="modal-alert" title="Aviso!!!" @ok="handleAlertOk">
      <b-alert variant="warning" show>
        <p>
          Antes de solicitar la verificación AdHoc, asegurese de adjuntar toda la documentación solicitada del
          expediente, una vez que solicite la verificación AdHoc
          <b>ya no podra adjuntar y modificar toda la documentación del expediente seleccionado.</b> Se le enviará una
          notificación si toda su documentación ingresada no esta conforme.
        </p>
      </b-alert>
      <template #modal-footer="{ ok }">
        <b-button type="submit" size="md" variant="warning" @click="ok()">
          <i class="far fa-thumbs-up"></i> Entiendo
        </b-button>
      </template>
    </b-modal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-4">
              <a href="/anexos SISTEMA.pdf" class="text-decoration" download>
                <i class="fas fa-download font-size-18"></i> Descargar Anexo Nro. 5 y Nro 6
              </a>
            </div>
            <div class="alert alert-warning m-0" v-if="totalRows == 0">
              <i class="fas fa-exclamation-triangle"></i> Debe ingresar un <b><u> nuevo expediente</u></b> y
              <b><u> solicitar el nº de hoja de trámite</u></b> antes de solicitar una verificación AdHoc.
            </div>
            <div class="alert alert-warning m-0" v-if="totalRows > 0">
              Recuerde primero <b><u> solicitar el nº de hoja de trámite</u></b> <br />
              Posteriormente, sírvase a <b><u>solicitar la verificación AdHoc</u></b> haciendo click en el boton
              <b>Solicitar</b> ( <b><i class="fas fa-paper-plane"></i></b> )
            </div>
          </div>
        </div>
      </div>
      <div class="col-12" v-if="totalRows != 0">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de expedientes existentes</h2>
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
                striped
              >
                <template #cell(estadisticas)="data">
                  <span class="text-info text-truncate mb-0">
                    <b>{{ data.value.completados }}</b>
                    de
                    <b>{{ data.value.total }}</b>
                  </span>
                </template>
                <template #cell(numero_hoja_tramite)="data">
                  <template v-if="data.value">
                    <span>
                      {{ data.value }}
                    </span>
                  </template>
                  <template v-else>
                    <span>---</span>
                  </template>
                </template>
                <template #cell(fecha_ingreso_ht)="data">
                  <template v-if="data.value">
                    <span v-b-tooltip.hover :title="$moment(String(data.value)).format('YYYY-MM-DD HH:MM')">
                      {{ $moment(String(data.value)).format('YYYY-MM-DD') }}
                    </span>
                  </template>
                  <template v-else>
                    <span>---</span>
                  </template>
                </template>
                <template #cell(estado_expediente_nombre)="data">
                  <template v-if="data.value == 'OBSERVADO'">
                    <span class="badge bg-soft-danger fw-semibold">
                      {{ data.value }}
                    </span>
                  </template>
                  <template v-else-if="data.value == 'SOLICITUD VERIFICACION'">
                    <span class="badge bg-soft-warning fw-semibold">
                      {{ data.value }}
                    </span>
                  </template>
                  <template v-else>
                    <span class="badge bg-soft-info fw-semibold">
                      {{ data.value }}
                    </span>
                  </template>
                </template>
                <template v-slot:cell(opciones)="data">
                  <template v-if="data.item.fecha_solicitud_ht && !data.item.fecha_ingreso_ht">
                    <button
                      type="button"
                      class="btn btn-outline-primary btn-sm"
                      v-b-tooltip.hover
                      :title="title"
                      @click="requestSolicitar(data.item)"
                    >
                      <i class="fas fa-paper-plane"></i> Solicitar
                    </button>
                  </template>
                  <template v-else>
                    <span class="text-info">---</span>
                  </template>
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

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-info m-0">
              Si desea realizar alguna consulta comuníquese con nosotros:
              <br /><br />
              <i class="far fa-envelope"></i>
              <a class="text-decoration" href="mailto:SoporteAdHoc@cenepred.gob.pe">SoporteAdHoc@cenepred.gob.pe</a>
              <br />
              <i class="far fa-envelope"></i>
              <a class="text-decoration" href="mailto:mesadepartes@cenepred.gob.pe">mesadepartes@cenepred.gob.pe</a>
              <br />
              <i class="fas fa-phone"></i>
              <a class="text-decoration" href="tel:01 2013550">(+51) 2013550</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
