<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pageTitle = 'Revisión de Expedientes AdHoc'

    return {
      title: pageTitle,
      items: [{ text: 'Admin' }, { text: 'Revisión de Expediente' }, { text: pageTitle, active: true }],
      urlTableData: '/entregaexpediente',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      sortDesc: true,
      sortBy: 'fecha_ingreso_ht',
      fields: [
        {
          label: 'Nombre Comercial',
          key: 'nombre_comercial',
          sortable: true
        },
        {
          label: 'Departamento',
          key: 'departamento_nombre',
          sortable: true
        },
        {
          label: 'Verificador Asignado',
          key: 'adhoc_full_name',
          sortable: true
        },
        {
          label: 'F. S. Hoja Trámite',
          key: 'fecha_solicitud_ht',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'F. S. Verificación',
          key: 'fecha_ingreso_ht',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Estado',
          key: 'estado_expediente_nombre',
          sortable: true,
          class: 'bs-date-col-left'
        },
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
          class: 'bs-option-col',
          thClass: 'bs-option-col-header'
        }
      ],
      listAcreditaciones: [],
      listEstadoExpediente: [],
      listEstadoRevision: [],
      hay_convocatoria_actual: '',
      estadoExpedienteSelected: null,
      estadoRevisionSelected: null,
      filter_estado_id: [],
      filter_nombre: ''
    }
  },
  watch: {
    estadoExpedienteSelected: function (val) {
      let estado_id = []

      for (let v of val) {
        estado_id.push(v.id)
      }

      this.filter_estado_id = estado_id
    }
  },
  mounted() {
    this.loadSelectOptions()
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
    requestShowItemDetail(item) {
      this.$nuxt.$emit('open-detalle-modal', item)
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
      let filter_estado = ''

      if (this.filter_estado_id.length > 0) {
        for (const v of this.filter_estado_id) {
          filter_estado += '&estado_expediente_id[]=' + v
        }
      }

      filters += `&per_page=${ctx.perPage}`
      filters += ctx.sortBy ? `&sortBy=${ctx.sortBy}` : ''
      filters += `&direction=${sortText}`
      filters += this.filter_nombre ? `&nombre_comercial=${this.filter_nombre}` : ''
      filters += filter_estado ? filter_estado : ''

      return filters
    },
    handleFiltrar() {
      this.refreshTable()
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaEntregaExpediente').then((res) => {
        this.listAcreditaciones = res.data.acreditaciones || []
        this.listEstadoExpediente = res.data.estado_expediente || []
        this.listEstadoRevision = res.data.estado_revision || []
        this.hay_convocatoria_actual = res.data.hay_convocatoria_actual ? true : false
      })
    },
    colorEstadoExpediente(estado) {
      let color = 'info'

      switch (estado) {
        case 'OBSERVADO':
          color = 'danger'
          break
        case 'SOLICITUD VERIFICACION':
          color = 'warning'
          break
      }

      return color
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <CenepredExpedienteDetalleModal></CenepredExpedienteDetalleModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning m-0" role="alert">
              Puede ver mas información haciendo click en la opción <b>Ver Detalle</b> (
              <b><i class="far fa-eye"></i></b> ) o actualizar un expediente con la opción <b>Editar</b> (
              <b><i class="uil uil-pen font-size-18"></i></b> )
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de expedientes a revisar</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <h4 class="card-title mb-4">Filtros:</h4>
              <div class="col-4 mb-3">
                <label class="form-label">Nombre Comercial:</label>
                <input type="text" class="form-control" v-model="filter_nombre" />
                <div class="form-text">Busca por el nombre completo o parcial.</div>
              </div>
              <div class="col-4 mb-3">
                <label class="form-label">Estado Expediente:</label>
                <multiselect-c
                  :multiple="true"
                  :options="listEstadoExpediente"
                  v-model="estadoExpedienteSelected"
                  label="nombre"
                  track-by="id"
                  placeholder="Elija un estado"
                >
                  <span slot="noResult">Oops! No se encontraron elementos.</span>
                </multiselect-c>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" @click="handleFiltrar">
                  <i class="fas fa-th-list"></i> Filtrar
                </button>
              </div>
            </div>
            <hr class="my-3" />
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
                <template #cell(fecha_solicitud_ht)="data">
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
                  <span class="badge fw-semibold" :class="`bg-soft-` + colorEstadoExpediente(data.value)">
                    {{ data.value }}
                  </span>
                </template>
                <template v-slot:cell(opciones)="data">
                  <ul class="list-inline two-options mb-0">
                    <li class="list-inline-item">
                      <a
                        href="javascript:void(0);"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Ver Detalle"
                        @click="requestShowItemDetail(data.item)"
                      >
                        <i class="uil uil-eye font-size-18"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <nuxt-link
                        :to="`/admin/cenepred/expediente/` + data.item.id"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Editar"
                      >
                        <i class="uil uil-pen font-size-18"></i>
                      </nuxt-link>
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
    </div>
  </div>
</template>
