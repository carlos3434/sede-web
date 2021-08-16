<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Detalle Expediente'
    }
  },
  data() {
    return {
      modalId: 'modal-detalle',
      openModalEvent: 'open-detalle-modal',
      item: {
        id: null,
        adhoc_full_name: '',
        cenepred_full_name: '',
        administrado_full_name: '',
        departamento_nombre: '',
        direccion: '',
        estado_expediente_nombre: '',
        fecha_entrega: '',
        fecha_ingreso_ht: '',
        fecha_solicitud_ht: '',
        nombre_comercial: '',
        numero_hoja_tramite: '',
        archivo_solicitud_ht: '',
        recibo_pago: '',
        area: ''
      }
    }
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (item) => {
      this.setItemValues(item)
      this.showModal()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off(this.openModalEvent)
  },
  computed: {
    colorEstadoExpediente() {
      let color = 'info'

      switch (this.item.estado_expediente_nombre) {
        case 'OBSERVADO':
          color = 'danger'
          break
        case 'SOLICITUD VERIFICACION':
          color = 'warning'
          break
      }

      return color
    }
  },
  methods: {
    showModal() {
      this.$bvModal.show(this.modalId)
    },
    hideModal() {
      this.$bvModal.hide(this.modalId)
    },
    setItemValues(item) {
      this.item.id = item.id
      this.item.adhoc_full_name = item.adhoc_full_name
      this.item.cenepred_full_name = item.cenepred_full_name
      this.item.administrado_full_name = item.administrado_full_name
      this.item.departamento_nombre = item.departamento_nombre
      this.item.direccion = item.direccion
      this.item.estado_expediente_nombre = item.estado_expediente_nombre
      this.item.fecha_entrega = item.fecha_entrega
      this.item.fecha_ingreso_ht = item.fecha_ingreso_ht
      this.item.fecha_solicitud_ht = item.fecha_solicitud_ht
      this.item.nombre_comercial = item.nombre_comercial
      this.item.numero_hoja_tramite = item.numero_hoja_tramite
      this.item.archivo_solicitud_ht = item.archivo_solicitud_ht
      this.item.recibo_pago = item.recibo_pago
      this.item.area = item.area
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" size="lg" @hidden="hideModal">
      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Usuario Administrado:</label>
            <p class="text-muted m-0">{{ item.administrado_full_name }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre Comercial:</label>
            <p class="text-muted m-0">{{ item.nombre_comercial }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <p class="text-muted m-0">{{ item.direccion }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Área (m²) comercial:</label>
            <p class="text-muted m-0">{{ item.area }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Departamento:</label>
            <p class="text-muted m-0">{{ item.departamento_nombre }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Nº de Hoja de Trámite:</label>
            <p class="text-muted m-0">{{ item.numero_hoja_tramite }}</p>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Estado del Expediente:</label>
            <p class="text-muted m-0">
              <span class="badge fw-semibold" :class="`bg-soft-` + colorEstadoExpediente">
                {{ item.estado_expediente_nombre }}
              </span>
            </p>
          </div>
          <div class="mb-3">
            <label class="form-label">Fecha de Solicitud Nº de Hoja de Trámite:</label>
            <p class="text-muted m-0">
              {{ item.fecha_solicitud_ht ? $moment(item.fecha_solicitud_ht).format('YYYY-MM-DD HH:MM') : '-----' }}
            </p>
          </div>
          <div class="mb-3">
            <label class="form-label">Fecha de Solicitud de Verificación AdHoc:</label>
            <p class="text-muted m-0">
              {{ item.fecha_ingreso_ht ? $moment(item.fecha_ingreso_ht).format('YYYY-MM-DD HH:MM') : '-----' }}
            </p>
          </div>
          <div class="mb-3">
            <label class="form-label">Archivo Anexo Nº 5:</label>
            <p class="text-muted m-0">
              <a
                href="javascript:void(0);"
                class="text-decoration"
                @click.stop="$downloadFile(item.archivo_solicitud_ht)"
              >
                <i class="uil uil-file-info-alt font-size-18"></i> Ver Archivo
              </a>
            </p>
          </div>
          <div class="mb-3">
            <label class="form-label">Archivo Recibo de Pago:</label>
            <p class="text-muted m-0">
              <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(item.recibo_pago)">
                <i class="uil uil-file-info-alt font-size-18"></i> Ver Archivo
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="row" v-if="item.estado_expediente_nombre == 'ENTREGADO'">
        <hr class="my-3" />
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Usuario Asignador (cenepred):</label>
            <p class="text-muted m-0">{{ item.cenepred_full_name }}</p>
          </div>
          <div class="mb-3">
            <label class="form-label">Verificador Asignado:</label>
            <p class="text-muted m-0">{{ item.adhoc_full_name }}</p>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Fecha de Entrega de Expediente:</label>
            <p class="text-muted m-0">
              {{ item.fecha_entrega ? $moment(item.fecha_entrega).format('YYYY-MM-DD HH:MM') : '-----' }}
            </p>
          </div>
        </div>
      </div>
      <template #modal-footer="{ cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cerrar </b-button>
      </template>
    </b-modal>
  </div>
</template>
