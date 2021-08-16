<script>
export default {
  layout: 'vertical',
  async asyncData({ params, redirect }) {
    if (!params.id) redirect(`/admin/administrado/expediente`)

    return {}
  },
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pagetitle = 'Revisión de Expediente AdHoc'
    let parentTitle = 'Revisión de Expediente'

    return {
      title: pagetitle,
      items: [{ text: 'Admin' }, { text: parentTitle }, { text: pagetitle, active: true }],
      msgSuccess: 'Expediente actualizado exitosamente!!!',
      item: {},
      id_expediente: null,
      loading: true,
      visiblePrincipales: false,
      visibleAmpliacion: false,
      visibleArquitectura: false,
      visibleRemodelacion: false,
      visibleEvacuacion: false,
      visibleFabrica: false,
      visibleSenalizacion: false,
      totalCargados: 0,
      totalAdmitidos: 0,
      totalObservados: 0,
      totalSubsanados: 0
    }
  },
  mounted() {
    this.getExpedienteData()
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
  created() {
    this.$nuxt.$on('refresh-table', () => {
      this.refreshExpedienteData()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off('refresh-table')
  },
  methods: {
    requestEntregaExpediente() {
      this.item.isValidEntregaExpediente = this.isValidEntregaExpediente()
      this.$nuxt.$emit('open-entrega-modal', this.item)
    },
    refreshExpedienteData() {
      this.getExpedienteData()
    },
    isValidEntregaExpediente() {
      return !this.checkEntregaExpediente()
    },
    checkEstadoExpediente() {
      let showEntregaBtn = true

      if (this.item.estado_expediente_nombre == 'ENTREGADO') {
        showEntregaBtn = false
      }

      return showEntregaBtn
    },
    checkEntregaExpediente() {
      let totalFiles = 0
      let totalAdmitidos = 0
      let totalObservados = 0
      let totalSubsanados = 0
      let files = this.item.expedienteadhoc_archivo

      for (const prop in files) {
        totalFiles = totalFiles + files[prop].estadisticas.completados
        totalAdmitidos = totalAdmitidos + files[prop].estadisticas.admitidos
        totalObservados = totalObservados + files[prop].estadisticas.observados
        totalSubsanados = totalSubsanados + files[prop].estadisticas.subsanados
      }

      this.totalCargados = totalFiles
      this.totalAdmitidos = totalAdmitidos
      this.totalObservados = totalObservados
      this.totalSubsanados = totalSubsanados

      return totalFiles != totalAdmitidos
    },
    async getExpedienteData() {
      this.id_expediente = this.$route.params.id
      let apiUrl = '/entregaexpediente/' + this.id_expediente

      await this.$axios
        .get(apiUrl)
        .then((res) => {
          if (!res) this.$router.push(`/admin/administrado/expediente`)

          this.item = res.data
          this.$nextTick(() => {
            this.checkEntregaExpediente()
          })
        })
        .finally(() => {
          this.loading = false
        })
    }
  },
  middleware: 'us-cenepred'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <CenepredExpedienteDetalleEditDocumentModal></CenepredExpedienteDetalleEditDocumentModal>
    <CenepredExpedienteDetalleEntregaModal></CenepredExpedienteDetalleEntregaModal>

    <div class="row mx-lg-4" v-if="loading">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <div class="spinner-border text-secondary" role="status">
                <span class="sr-only">Cargando...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mx-lg-4" v-else>
      <div class="col-lg-12">
        <div class="card" v-if="checkEstadoExpediente()">
          <div class="card-body">
            <div class="alert alert-warning m-0">
              <p class="m-0">
                La opción <b>Entrega de Expediente</b> se habilitará al terminar de revisar <b>todos</b> los documentos
                adjuntados.
              </p>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
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
                  <p class="text-muted m-0">{{ item.departamento_nombre ? item.departamento_nombre : '-----' }}</p>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nº de Hoja de Trámite:</label>
                  <p class="text-muted m-0">{{ item.numero_hoja_tramite }}</p>
                </div>
              </div>
              <div class="col-12 col-sm-6">
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
                    {{
                      item.fecha_solicitud_ht ? $moment(item.fecha_solicitud_ht).format('YYYY-MM-DD HH:MM') : '-----'
                    }}
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
            <div class="row" v-if="!checkEstadoExpediente()">
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
            <div class="row">
              <div class="col-12">
                <b-button
                  type="submit"
                  size="md"
                  variant="success"
                  :disabled="checkEntregaExpediente()"
                  v-if="checkEstadoExpediente()"
                  @click="requestEntregaExpediente"
                >
                  <i class="fas fa-handshake"></i> Entrega de Expediente
                </b-button>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">
              Revisar Documentos
              <span class="text-subsection text-muted">
                Total documentos:
                <span class="text-info">
                  <b>{{ totalCargados }}</b> cargados.
                </span>
                <span class="text-success">
                  <b>{{ totalAdmitidos }}</b> admintidos.
                </span>
                <span class="text-danger">
                  <b>{{ totalObservados }}</b> observados.
                </span>
                <span class="text-secondary">
                  <b>{{ totalSubsanados }}</b> subsanados.
                </span>
              </span>
            </h2>
          </div>
          <div class="card-body">
            <div class="custom-accordion">
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.documentos_principales"
                :visible="visiblePrincipales"
                :numero="`1`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_arquitectura"
                :visible="visibleArquitectura"
                :numero="`2`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.plans_fabrica_inscrita"
                :visible="visibleFabrica"
                :numero="`3`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_remodelacion"
                :visible="visibleRemodelacion"
                :numero="`4`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_ampliacion"
                :visible="visibleAmpliacion"
                :numero="`5`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_rutas_evacuacion"
                :visible="visibleEvacuacion"
                :numero="`6`"
              ></CenepredExpedienteDetalleDocumentos>
              <CenepredExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_senalizacion"
                :visible="visibleSenalizacion"
                :numero="`7`"
              ></CenepredExpedienteDetalleDocumentos>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
