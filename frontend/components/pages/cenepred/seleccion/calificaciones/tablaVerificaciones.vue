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
      sortBy: 'fecha',
      fields: [
        {
          label: 'Institución',
          key: 'institucion',
          sortable: true
        },
        {
          label: 'Nro. Expediente',
          key: 'nro_expediente',
          sortable: true,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Nro. Informe',
          key: 'nro_informe',
          sortable: true,
          class: 'bs-nro-document-col'
        },
        {
          label: 'Fecha',
          key: 'fecha',
          sortable: true,
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
