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
      sortBy: 'fecha_expedicion',
      fields: [
        {
          label: 'Especialidad',
          key: 'especialidad',
          sortable: true
        },
        {
          label: 'F. Expedición',
          key: 'fecha_expedicion',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Ciudad',
          key: 'ciudad',
          sortable: true,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Grado',
          key: 'grado',
          sortable: true,
          class: 'bs-date-col'
        },
        {
          label: 'Institución',
          key: 'institucion',
          sortable: true
        },
        {
          label: 'Certificado',
          key: 'archivo_titulo',
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
        <template #cell(archivo_titulo)="data">
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
