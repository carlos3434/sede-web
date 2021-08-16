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
      title: 'Resultados',
      items: [{ text: 'Admin' }, { text: 'Selección verificadores AdHoc' }, { text: 'Resultados', active: true }],
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
          label: 'Fecha',
          key: 'fecha',
          sortable: true,
          visible: true,
          class: 'bs-date-col'
        },
        {
          label: 'Opciones',
          key: 'opciones',
          sortable: false,
          visible: true,
          class: 'bs-option-col',
          thClass: 'bs-option-col-header'
        }
      ],
      listConvocatorias: [],
      listSedes: [],
      convocatoriaSelected: null,
      sedeSelected: null
    }
  },
  computed: {
    visibleFields() {
      return this.fields.filter((f) => f.visible)
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
    requestAcreditarItem(item) {
      this.$nuxt.$emit('open-acreditar-modal', item)
    },
    refreshTable() {
      this.$refs.table.refresh()
    },
    getItems(ctx) {
      this.isBusy = false

      if (!this.convocatoriaSelected) {
        return []
      }

      let filters = this.filtersTable(ctx)
      let url = `/calificacion/${this.convocatoriaSelected.id}/resultados`
      let promise = this.$axios.get(url + filters)

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
      filters += this.sedeSelected ? `&sede_registral_id=${this.sedeSelected.id}` : ''
      filters += `&direction=${sortText}`
      return filters
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaCalificacion').then((res) => {
        this.listConvocatorias = res.data.convocatorias || []
        this.listSedes = res.data.sedes_registrales || []
      })
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
              Resultados de la convocatoria:
              <template v-if="convocatoriaSelected">
                <span class="text-info">{{ convocatoriaSelected.nombre }}</span>
              </template>
              <template v-if="convocatoriaSelected && !sedeSelected"> en todas las sedes. </template>
              <template v-if="convocatoriaSelected && sedeSelected">
                en la sede <span class="text-info">{{ sedeSelected.nombre }}</span>
              </template>
            </h2>
          </div>
          <div class="card-body">
            <div class="row mt-1">
              <div class="col-sm-12 col-md-6">
                <div class="mb-4">
                  <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
                    <b-form @submit.prevent="handleSubmit()">
                      <ValidationProvider rules="required" name="Convocatorias" v-slot="{ valid, errors }">
                        <b-form-group label="Convocatorias:" class="mb-3">
                          <multiselect-c
                            :options="listConvocatorias"
                            v-model="convocatoriaSelected"
                            label="nombre"
                            track-by="id"
                            placeholder="Elija una convocatoria"
                            :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                          >
                            <span slot="noResult">Oops! No se encontraron elementos.</span>
                          </multiselect-c>
                          <div class="invalid-feedback" style="display: block" v-show="errors.length">
                            {{ errors[0] }}
                          </div>
                        </b-form-group>
                      </ValidationProvider>
                      <b-form-group label="Sede Registral:" class="mb-3">
                        <multiselect-c
                          :options="listSedes"
                          v-model="sedeSelected"
                          label="nombre"
                          track-by="id"
                          placeholder="Todas las sedes"
                        >
                          <span slot="noResult">Oops! No se encontraron elementos.</span>
                        </multiselect-c>
                      </b-form-group>
                      <div class="mb-3">
                        <button type="submit" @click="refreshTable" class="btn btn-primary">Ver Resultados</button>
                      </div>
                    </b-form>
                  </ValidationObserver>
                </div>
              </div>
              <hr />
              <div class="col-sm-12 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                  <label class="d-inline-flex align-items-center">
                    Mostrar&nbsp;&nbsp;
                    <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                    &nbsp;&nbsp;registros
                  </label>
                </div>
              </div>
            </div>
            <!-- Table -->
            <div class="table-responsive mb-0">
              <b-table
                ref="table"
                responsive="sm"
                :busy="isBusy"
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
                <template v-slot:cell(opciones)="data">
                  <ul class="list-inline two-options mb-0">
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
