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
      title: 'Calificación',
      items: [{ text: 'Admin' }, { text: 'Selección verificadores AdHoc' }, { text: 'Calificación', active: true }],
      nombreConvocatoria: '',
      filtro: '',
      puntaje: '',
      urlTableData: '/calificacion',
      tableData: this.getItems,
      isBusy: false,
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      sortDesc: false,
      sortBy: 'usuario_apellido_paterno',
      fields: [
        {
          label: 'Nro. Documento',
          key: 'usuario_numero_documento',
          sortable: true,
          visible: true,
          class: 'bs-date-col'
        },
        {
          label: 'Usuario AdHoc',
          key: 'usuario_nombres',
          sortable: true,
          visible: true
        },
        {
          label: 'Sede',
          key: 'sede_registral_nombre',
          sortable: true,
          visible: true
        },
        {
          label: 'Puntaje Total',
          key: 'puntaje_total',
          sortable: true,
          visible: true,
          class: 'bs-date-col'
        },
        {
          label: '¿Acreditado?',
          key: 'esta_acreditado',
          sortable: true,
          visible: true,
          class: 'bs-date-col'
        },
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
          visible: true,
          class: 'bs-option-col-left',
          thClass: 'bs-option-col-header'
        }
      ]
    }
  },
  watch: {
    filtro: function (val) {
      this.puntaje = val == '' ? '' : this.puntaje
    }
  },
  computed: {
    visibleFields() {
      return this.fields.filter((f) => f.visible)
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
    requestAcreditarItem(item) {
      this.$nuxt.$emit('open-acreditar-modal', item)
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

          this.nombreConvocatoria = res.data.additional_data.convocatoria_actual.nombre
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
      filters += this.filtro ? `&filtro=${this.filtro}` : ''
      filters += this.puntaje ? `&puntaje=${this.puntaje}` : ''
      return filters
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <CenepredSeleccionCalificacionesAcreditarModal></CenepredSeleccionCalificacionesAcreditarModal>

    <div class="row mx-lg-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">
              Calificaciones de la convocatoria: <span class="text-info">{{ nombreConvocatoria }}</span>
            </h2>
          </div>
          <div class="card-body">
            <div class="row mt-4">
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                  <label class="d-inline-flex align-items-center">
                    Mostrar&nbsp;&nbsp;
                    <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                    &nbsp;&nbsp;registros
                  </label>
                </div>
              </div>
              <!-- Search -->
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_filter" class="dataTables_filter text-md-end float-end">
                  <div class="input-group mb-3">
                    <select v-model="filtro" class="form-select select-filtro">
                      <option value="">Sin Filtro</option>
                      <option value="=">Igual a:</option>
                      <option value=">">Mayor que:</option>
                      <option value=">=">Mayor o igual que:</option>
                      <option value="<">Menor que:</option>
                      <option value="<=">Menor o igual que:</option>
                    </select>
                    <input v-model="puntaje" class="form-control select-puntaje" type="number" placeholder="0" />
                    <button @click="refreshTable" class="btn btn-primary" type="button">Filtrar por puntaje</button>
                  </div>
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
                :class="`table-nowrap`"
                striped
                show-empty
              >
                <template #empty="">
                  <p class="text-center">No hay registros para mostrar</p>
                </template>
                <template #cell(usuario_nombres)="data">
                  {{ data.value }}
                  {{ data.item.usuario_apellido_paterno }}
                  {{ data.item.usuario_apellido_materno }}
                </template>
                <template #cell(esta_acreditado)="data">
                  <b :class="`text-` + (data.value ? `info` : `danger`)">
                    {{ data.value ? 'Si' : 'No' }}
                  </b>
                </template>
                <template v-slot:cell(opciones)="data">
                  <ul class="list-inline two-options mb-0">
                    <li class="list-inline-item" v-permission="'CALIFICACION_SHOW'">
                      <nuxt-link
                        :to="`/admin/cenepred/seleccion/calificacion/` + data.item.id + `/detalle`"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Ver Datos"
                      >
                        <i class="uil uil-eye font-size-18"></i>
                      </nuxt-link>
                    </li>
                    <li class="list-inline-item" v-permission="'CALIFICACION_EDIT'" v-if="!data.item.esta_calificado">
                      <nuxt-link
                        :to="`/admin/cenepred/seleccion/calificacion/` + data.item.id + `/calificar`"
                        class="px-1 text-primary"
                        v-b-tooltip.hover
                        title="Calificar"
                      >
                        <i class="uil uil-star font-size-18"></i>
                      </nuxt-link>
                    </li>
                    <li class="list-inline-item" v-permission="'ACREDITACION_CREATE'" v-if="!data.item.esta_acreditado">
                      <a
                        href="javascript:void(0);"
                        class="px-1 text-success"
                        v-b-tooltip.hover
                        title="Acreditar"
                        @click="requestAcreditarItem(data.item)"
                      >
                        <i class="uil uil-award font-size-18"></i>
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
<style scoped lang="scss">
.card-body::v-deep {
  .select-filtro {
    max-width: 165px;
    width: 165px;
  }
  .select-puntaje {
    max-width: 100px;
    width: 100px;
  }
}
</style>
