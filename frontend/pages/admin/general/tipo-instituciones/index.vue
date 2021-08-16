<script>
export default {
  layout: 'vertical',
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pageTitle = 'Tipo de Instituciones'

    return {
      title: pageTitle,
      items: [{ text: 'Admin' }, { text: 'Mantenimiento' }, { text: pageTitle, active: true }],
      urlTableData: '/tipoinstitucion',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      sortDesc: false,
      sortBy: 'nombre',
      fields: [
        {
          key: 'nombre',
          label: 'Nombre',
          sortable: true
        },
        {
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
    requestEditItem(item) {
      this.$nuxt.$emit('open-edit-modal', item)
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
      filters += `&nombre=${ctx.filter}`
      filters += `&sortBy=${ctx.sortBy}`
      filters += `&direction=${sortText}`
      return filters
    }
  },
  middleware: 'us-admin'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <GeneralTipoInstitucionAddModal></GeneralTipoInstitucionAddModal>
    <GeneralTipoInstitucionEditModal></GeneralTipoInstitucionEditModal>
    <GeneralTipoInstitucionDeleteModal></GeneralTipoInstitucionDeleteModal>

    <div class="row mx-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de tipo de instituciones</h2>
            <div class="card-options" v-permission="'TIPO_INSTITUCION_CREATE'">
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
              <!-- Search -->
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_filter" class="dataTables_filter text-md-end">
                  <label class="d-inline-flex align-items-center">
                    Buscar:&nbsp;
                    <b-form-input
                      v-model="filter"
                      type="search"
                      class="form-control form-control-sm ml-2"
                    ></b-form-input>
                  </label>
                </div>
              </div>
              <!-- End search -->
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
                <template v-slot:cell(opciones)="data">
                  <ul class="list-inline two-options mb-0">
                    <li class="list-inline-item" v-permission="'TIPO_INSTITUCION_DESTROY'">
                      <a
                        href="javascript:void(0);"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Editar"
                        @click="requestEditItem(data.item)"
                      >
                        <i class="uil uil-pen font-size-18"></i>
                      </a>
                    </li>
                    <li class="list-inline-item" v-permission="'TIPO_INSTITUCION_EDIT'">
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
    </div>
  </div>
</template>
