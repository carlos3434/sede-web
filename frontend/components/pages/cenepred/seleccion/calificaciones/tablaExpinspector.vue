<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => {
        return []
      }
    }
  },
  data() {
    return {
      tableData: this.items,
      totalRows: this.items.length,
      currentPage: 1,
      perPage: 5,
      sortDesc: false,
      sortBy: 'fecha_inicio',
      fields: [
        {
          label: 'Institución',
          key: 'institucion',
          sortable: true
        },
        {
          label: 'F. Inicio',
          key: 'fecha_inicio',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'F. Fin',
          key: 'fecha_fin',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Constancia',
          key: 'archivo_constancia',
          sortable: false,
          class: 'bs-date-col'
        }
      ]
    }
  }
}
</script>

<template>
  <div>
    <div class="table-responsive mb-0">
      <b-table
        ref="table"
        responsive="true"
        :items="tableData"
        :fields="fields"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        striped
        borderless
        :class="`table-nowrap`"
      >
        <template #cell(archivo_constancia)="data">
          <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(data.value)">
            <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
          </a>
        </template>
      </b-table>
    </div>
    <div class="row">
      <div class="col">
        <div class="dataTables_paginate paging_simple_numbers float-end">
          <ul class="pagination pagination-rounded mb-0">
            <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage"></b-pagination>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
