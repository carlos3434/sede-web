<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pageTitle = 'Expedientes AdHoc'

    return {
      title: pageTitle,
      items: [
        { text: 'Admin' },
        { text: 'Diligencia y formulación del informe AdHoc' },
        { text: pageTitle, active: true }
      ],
      urlTableData: '/diligenciaverificador',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      sortDesc: true,
      sortBy: 'fecha_entrega',
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
          label: 'Fecha Entrega',
          key: 'fecha_entrega',
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
          label: 'Anexo 8',
          key: 'anexo8',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Anexo 9',
          key: 'anexo9',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Anexo 10',
          key: 'anexo10',
          sortable: true,
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
    }
  },
  middleware: 'us-adhoc'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning m-0" role="alert">
              Puede ver mas información haciendo click en la opción <b>Ver Detalle</b> (
              <b><i class="far fa-eye"></i></b> )
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de expedientes asignados</h2>
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
                <template #cell(anexo8)="data">
                  <template v-if="data.value">
                    <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(data.value)">
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </template>
                  <template v-else>
                    <span>---</span>
                  </template>
                </template>
                <template #cell(anexo9)="data">
                  <template v-if="data.value">
                    <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(data.value)">
                      <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                    </a>
                  </template>
                  <template v-else>
                    <span>---</span>
                  </template>
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
                <template #cell(fecha_entrega)="data">
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
                  <template v-if="data.value == 'ENTREGADO'">
                    <span class="badge bg-soft-success fw-semibold">
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
                  <nuxt-link :to="`/admin/adhoc/expediente/` + data.item.id" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i> Ver Detalle
                  </nuxt-link>
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
