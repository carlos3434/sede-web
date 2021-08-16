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
    let pagetitle = 'Expediente AdHoc'
    let parentTitle = 'Diligencia y formulación del informe AdHoc'

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
    },
    totalDocumentos() {
      let totalDocumentos = 0
      let files = this.item.expedienteadhoc_archivo

      for (const prop in files) {
        totalDocumentos = totalDocumentos + files[prop].estadisticas.completados
      }

      return totalDocumentos
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
    requestAnexo8() {
      this.$nuxt.$emit('open-anexo8-modal', this.item)
    },
    requestAnexo9() {
      this.$nuxt.$emit('open-anexo9-modal', this.item)
    },
    requestAnexo10() {
      this.$nuxt.$emit('open-anexo10-modal', this.item)
    },
    refreshExpedienteData() {
      this.getExpedienteData()
    },
    async getExpedienteData() {
      this.id_expediente = this.$route.params.id
      let apiUrl = '/diligenciaverificador/' + this.id_expediente

      await this.$axios
        .get(apiUrl)
        .then((res) => {
          if (!res) this.$router.push(`/admin/administrado/expediente`)

          this.item = res.data
        })
        .finally(() => {
          this.loading = false
        })
    }
  },
  middleware: 'us-adhoc'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <AdhocExpedienteDetalleAnexo8Modal></AdhocExpedienteDetalleAnexo8Modal>
    <AdhocExpedienteDetalleAnexo9Modal></AdhocExpedienteDetalleAnexo9Modal>
    <AdhocExpedienteDetalleAnexo10Modal></AdhocExpedienteDetalleAnexo10Modal>

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
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning m-0">
              <p class="m-0">
                Por favor adjunta el <b>Anexo Nº 8</b>, posteriormente el <b>Anexo Nº 9</b> y finalmente el
                <b>Anexo Nº 10</b>
              </p>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
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
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label">Usuario Administrado:</label>
                  <p class="text-muted m-0">{{ item.administrado_full_name }}</p>
                </div>
                <div class="mb-3">
                  <label class="form-label">Estado del Expediente:</label>
                  <p class="text-muted m-0">
                    <span class="badge fw-semibold" :class="`bg-soft-` + colorEstadoExpediente">
                      {{ item.estado_expediente_nombre }}
                    </span>
                  </p>
                </div>
                <div class="mb-3">
                  <label class="form-label">Fecha de Entrega de Expediente:</label>
                  <p class="text-muted m-0">
                    {{ item.fecha_entrega ? $moment(item.fecha_entrega).format('YYYY-MM-DD HH:MM') : '-----' }}
                  </p>
                </div>
                <div class="mb-3" v-if="item.anexo8 || item.anexo9 || item.anexo10">
                  <label class="form-label">Anexos:</label>
                  <p class="text-muted m-0">
                    <a
                      href="javascript:void(0);"
                      class="text-decoration pe-2"
                      @click.stop="$downloadFile(item.anexo8)"
                      v-if="item.anexo8"
                    >
                      <i class="uil uil-file-download font-size-18"></i> Ver Anexo Nº 8
                    </a>
                    <a
                      href="javascript:void(0);"
                      class="text-decoration pe-2"
                      @click.stop="$downloadFile(item.anexo9)"
                      v-if="item.anexo9"
                    >
                      <i class="uil uil-file-download font-size-18"></i> Ver Anexo Nº 9
                    </a>
                    <a
                      href="javascript:void(0);"
                      class="text-decoration"
                      @click.stop="$downloadFile(item.anexo10)"
                      v-if="item.anexo10"
                    >
                      <i class="uil uil-file-download font-size-18"></i> Ver Anexo Nº 10
                    </a>
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <b-button type="button" variant="outline-primary" @click="requestAnexo8" v-if="!item.anexo8">
                  <i class="fas fa-upload"></i> Adjuntar Anexo Nº 8
                </b-button>
                <b-button
                  type="button"
                  variant="outline-primary"
                  @click="requestAnexo9"
                  v-if="!item.anexo9"
                  :disabled="!item.anexo8"
                >
                  <i class="fas fa-upload"></i> Adjuntar Anexo Nº 9
                </b-button>
                <b-button
                  type="button"
                  variant="outline-primary"
                  @click="requestAnexo10"
                  v-if="!item.anexo10"
                  :disabled="!item.anexo9"
                >
                  <i class="fas fa-upload"></i> Adjuntar Anexo Nº 10
                </b-button>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">
              Revisar Documentos
              <span style="font-size: 0.8rem; font-style: italic" class="text-muted">
                Total documentos:
                <span class="text-info">
                  <b>{{ totalDocumentos }}</b> cargados.
                </span>
              </span>
            </h2>
          </div>
          <div class="card-body">
            <div class="custom-accordion">
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.documentos_principales"
                :visible="visiblePrincipales"
                :numero="`1`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_arquitectura"
                :visible="visibleArquitectura"
                :numero="`2`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.plans_fabrica_inscrita"
                :visible="visibleFabrica"
                :numero="`3`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_remodelacion"
                :visible="visibleRemodelacion"
                :numero="`4`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_ampliacion"
                :visible="visibleAmpliacion"
                :numero="`5`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_rutas_evacuacion"
                :visible="visibleEvacuacion"
                :numero="`6`"
              ></AdhocExpedienteDetalleDocumentos>
              <AdhocExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_senalizacion"
                :visible="visibleSenalizacion"
                :numero="`7`"
              ></AdhocExpedienteDetalleDocumentos>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
