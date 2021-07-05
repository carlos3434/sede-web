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
      title: 'Documentos',
      items: [{ text: 'Admin' }, { text: 'Curriculum Vitae' }, { text: 'Documentos', active: true }],
      isBusy: false,
      tableData: this.getItems,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: '',
      filterOn: [],
      sortBy: 'especialidad',
      sortDesc: false,
      fields: [
        {
          label: 'Título o Grado',
          key: 'grado',
          sortable: false,
          visible: true
        },
        {
          label: 'Especialidad',
          key: 'especialidad',
          sortable: true,
          visible: true
        },
        {
          label: 'F. Expedición',
          key: 'fecha_expedicion',
          sortable: true,
          visible: true,
          class: 'text-center'
        },
        {
          label: 'Institución',
          key: 'institucion',
          sortable: false,
          visible: true
        },
        {
          label: 'Ciudad',
          key: 'ciudad',
          sortable: true,
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
  computed: {
    userEstaPostulando() {
      let u = this.$auth.user.esta_postulando
      this.fields.map((field) => {
        if (field.key === 'opciones' && u) {
          field.visible = false
        }
      })
      return u
    },
    visibleFields() {
      return this.fields.filter((field) => field.visible)
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
      let promise = this.$axios.get('/formaciones' + filters)

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
      filters += ctx.filter ? `&especialidad=${ctx.filter}` : ''
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
    <CvFormacionGradeAddModal></CvFormacionGradeAddModal>
    <CvFormacionGradeEditModal></CvFormacionGradeEditModal>
    <CvFormacionGradeDeleteModal></CvFormacionGradeDeleteModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Listado de documentos</h2>
            <div class="card-options" v-permission:all="'FORMACION_CREATE'" v-show="!userEstaPostulando">
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
                :fields="visibleFields"
                :per-page="perPage"
                :current-page="currentPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :filter="filter"
                :filter-included-fields="filterOn"
                striped
              >
                <template v-slot:cell(opciones)="data" v-if="!userEstaPostulando">
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item" v-permission="'FORMACION_EDIT'">
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
                    <li class="list-inline-item" v-permission="'FORMACION_DESTROY'">
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
