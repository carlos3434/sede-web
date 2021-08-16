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
        label: 'Estado Revisión',
        key: 'estado_revision_nombre',
        sortable: false,
        class: 'bs-option-col-left',
        thClass: 'bs-option-col-header'
      },
      {
        label: 'Archivo',
        key: 'valor_archivo',
        sortable: false,
        class: 'bs-option-col-left',
        thClass: 'bs-option-col-header'
      },
      {
        label: 'Opciones',
        key: 'opciones',
        sortable: false,
        class: 'bs-option-col',
        thClass: 'bs-option-col-header'
      }
    ]
  }),
  methods: {
    refreshTable() {
      this.getExpedienteData()
    },
    requestSolicitar(item) {
      item.id_expediente = this.id_expediente
      this.$nuxt.$emit('open-edit-modal', item)
    },
    colorEstadoDocumento(itemStadus) {
      let color = 'info'

      switch (itemStadus) {
        case 'OBSERVADO':
          color = 'danger'
          break
      }

      return color
    },
    checkEstadoDocumento(estado) {
      let isValid = false

      // Aceptar visualizar el boton "Revision" solo en estas condiciones
      if (estado == null || estado == '' || estado == 'SUBSANADO') {
        isValid = true
      }

      return isValid
    }
  }
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
            <p class="text-info text-truncate mb-0">
              <span class="text-success">
                <b>{{ categoria.estadisticas.admitidos }}</b>
                admintidos.
              </span>
              <span class="text-danger">
                <b>{{ categoria.estadisticas.observados }}</b>
                observados.
              </span>
              <span class="text-secondary">
                <b>{{ categoria.estadisticas.subsanados }}</b>
                subsanados.
              </span>
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
          <template v-slot:cell(estado_revision_nombre)="data">
            <template v-if="data.item.valor_archivo && data.value">
              <span class="badge font-size-12" :class="`bg-soft-` + colorEstadoDocumento(data.value)">
                {{ data.value }}
              </span>
            </template>
          </template>
          <template v-slot:cell(opciones)="data">
            <template v-if="data.item.valor_archivo && checkEstadoDocumento(data.item.estado_revision_nombre)">
              <button type="button" class="btn btn-outline-primary btn-sm" @click="requestSolicitar(data.item)">
                <i class="fas fa-eye"></i> Revisión
              </button>
            </template>
          </template>
        </b-table>
      </div>
    </b-collapse>
  </div>
</template>
