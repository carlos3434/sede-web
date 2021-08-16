<script>
export default {
  props: {
    categoria: {
      type: Object,
      default: {}
    },
    id_expediente: {
      type: String,
      default: null
    },
    visible: {
      type: Boolean,
      default: false
    },
    numero: {
      type: String,
      default: '00'
    }
  },
  data: () => ({
    fields: [
      {
        label: 'Documento',
        key: 'nombre_archivo',
        sortable: false
      },
      {
        label: 'Archivo',
        key: 'valor_archivo',
        sortable: false,
        class: 'bs-option-col',
        thClass: 'bs-option-col-header'
      }
    ]
  }),
  methods: {}
}
</script>

<template>
  <div class="card" style="border-top: 2px solid #50a5f1">
    <a href="javascript: void(0);" class="text-dark" data-toggle="collapse" v-b-toggle="`documentos-` + numero">
      <div class="p-2">
        <div class="media align-items-center">
          <div class="me-3">
            <div class="avatar-xs">
              <div class="avatar-title rounded-circle bg-soft-primary text-primary">{{ numero }}</div>
            </div>
          </div>
          <div class="media-body overflow-hidden">
            <h5 class="font-size-16 mb-1">
              {{ categoria.nombre }}
            </h5>
            <p class="text-info text-truncate mb-0">
              <b>{{ categoria.estadisticas.completados }}</b>
              de
              <b>{{ categoria.estadisticas.total }}</b>
              documentos cargados
            </p>
          </div>
          <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
        </div>
      </div>
    </a>

    <b-collapse :id="`documentos-` + numero" :visible="visible">
      <div class="p-4 border-top">
        <b-table hover :items="categoria.archivos" :fields="fields">
          <template #cell(valor_archivo)="data">
            <template v-if="data.value">
              <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(data.value)">
                <i class="uil uil-file-info-alt font-size-18"></i> Ver Documento
              </a>
            </template>
            <template v-else>
              <span class="text-danger"> <i class="uil uil-multiply font-size-18"></i> Sin documento </span>
            </template>
          </template>
        </b-table>
      </div>
    </b-collapse>
  </div>
</template>
