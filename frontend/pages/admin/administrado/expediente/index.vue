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
      title: 'Registro de Expediente AdHoc',
      items: [{ text: 'Admin' }, { text: 'Curriculum Vitae' }, { text: 'Registro de Expediente AdHoc', active: true }],
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
          label: 'Dirección',
          key: 'direccion',
          sortable: true
        },
        {
          label: 'Área (m²)',
          key: 'area',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Documentos Cargados',
          key: 'estadisticas',
          sortable: false,
          class: 'bs-nro-document-col'
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
  created() {
    this.$nuxt.$on('refresh-table', () => {
      this.refreshTable()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off('refresh-table')
  },
  methods: {
    requestDeleteItem(item) {
      this.$nuxt.$emit('open-delete-modal', item)
    },
    requestAddItem() {
      this.$nuxt.$emit('open-add-modal')
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
    checkStatusToEdit(item) {
      let status = false

      switch (item.estado_expediente_nombre) {
        case 'CREADO':
          status = true
          break
        case 'OBSERVADO':
          status = true
          break
        default:
      }
      return status
    },
    checkStatusToDelete(item) {
      let status = false

      switch (item.estado_expediente_nombre) {
        case 'CREADO':
          status = true
          break
        default:
      }
      return status
    }
  },
  middleware: 'us-administrado'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <AdministradoExpedienteAddModal></AdministradoExpedienteAddModal>
    <AdministradoExpedienteDeleteModal></AdministradoExpedienteDeleteModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-4">
              <a href="/anexos SISTEMA.pdf" class="text-decoration" download>
                <i class="fas fa-download font-size-18"></i> Descargar Anexo Nro. 5 y Nro 6
              </a>
            </div>
            <div class="alert alert-warning m-0" role="alert">
              Despues de <b>Agregar</b> (<b><i class="fa fa-fw fa-plus"></i></b>) un nuevo expediente sírvase a ingresar
              toda la documentación haciendo click en el boton <b>Editar</b> (
              <b><i class="uil uil-pen font-size-18"></i></b>)
              <br />
              <b>Nota:</b> No puede editar expedientes en proceso de solicitud de hoja tramite o verificación AdHoc
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de expedientes existentes</h2>
            <div class="card-options" v-permission="'EXPEDIENTE_ADHOC_CREATE'">
              <b-button size="sm" variant="success" class="w-sm" @click="requestAddItem()">
                <i class="fa fa-fw fa-plus"></i> Agregar
              </b-button>
            </div>
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
                <template #cell(estadisticas)="data">
                  <span class="text-info text-truncate mb-0">
                    <b>{{ data.value.completados }}</b>
                    de
                    <b>{{ data.value.total }}</b>
                  </span>
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
                  <ul class="list-inline two-options mb-0">
                    <li class="list-inline-item" v-if="!checkStatusToEdit(data.item)">
                      <nuxt-link
                        :to="`/admin/administrado/expediente/` + data.item.id"
                        class="px-1 text-success"
                        v-b-tooltip.hover
                        title="Ver Detalle"
                      >
                        <i class="uil uil-eye font-size-18"></i>
                      </nuxt-link>
                    </li>
                    <li
                      class="list-inline-item"
                      v-permission="'EXPEDIENTE_ADHOC_EDIT'"
                      v-if="checkStatusToEdit(data.item)"
                    >
                      <nuxt-link
                        :to="`/admin/administrado/expediente/` + data.item.id"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Editar"
                      >
                        <i class="uil uil-pen font-size-18"></i>
                      </nuxt-link>
                    </li>
                    <li
                      class="list-inline-item"
                      v-permission="'EXPEDIENTE_ADHOC_DESTROY'"
                      v-if="checkStatusToDelete(data.item)"
                    >
                      <a
                        href="javascript:void(0);"
                        class="px-1 text-danger"
                        v-b-tooltip.hover
                        title="Eliminar"
                        @click="requestDeleteItem(data.item)"
                      >
                        <i class="uil uil-trash-alt font-size-18"></i>
                      </a>
                    </li>
                  </ul>
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
