<script>
export default {
  layout: 'vertical',
  async asyncData({ params, redirect }) {
    if (!params.id) redirect(`/admin/administrado/expediente`)

    let id_expediente = params.id

    return { id_expediente }
  },
  head() {
    return {
      title: `${this.title} | CENEPRED`
    }
  },
  data() {
    let pagetitle = 'Editar Expediente AdHoc'
    let parentTitle = 'Selección verificadores AdHoc'

    return {
      title: pagetitle,
      items: [{ text: 'Admin' }, { text: parentTitle }, { text: pagetitle, active: true }],
      msgSuccess: 'Expediente actualizado exitosamente!!!',
      item: {},
      loading: true,
      visiblePrincipales: false,
      visibleAmpliacion: false,
      visibleArquitectura: false,
      visibleRemodelacion: false,
      visibleEvacuacion: false,
      visibleFabrica: false,
      visibleSenalizacion: false
    }
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
    checkStatusToEdit() {
      let status = false

      switch (this.item.estado_expediente_nombre) {
        case 'CREADO':
          status = true
          break
        case 'OBSERVADO':
          status = true
          break
        default:
      }
      return status
    }
  },
  mounted() {
    this.getExpedienteData()
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
    refreshExpedienteData() {
      this.getExpedienteData()
    },
    onSubmitForm() {
      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }

        let data = new FormData()
        data.append('_method', 'put')
        data.append('nombre_comercial', this.item.nombre_comercial)
        data.append('direccion', this.item.direccion)
        data.append('area', this.item.area)

        this.$axios
          .post('/expedienteadhoc/' + this.id_expediente, data)
          .then((res) => {
            this.$notify({ type: 'success', text: this.msgSuccess })
          })
          .finally(() => {
            this.$refs.form.reset()
          })
      })
    },
    async getExpedienteData() {
      let apiUrl = '/expedienteadhoc/' + this.id_expediente

      await this.$axios
        .get(apiUrl)
        .then((res) => {
          if (!res) this.$router.push(`/admin/administrado/expediente`)

          this.item = res ? res.data : {}
        })
        .finally(() => {
          this.loading = false
        })
    }
  },
  middleware: 'us-administrado'
}
</script>

<template>
  <div>
    <PageHeader :title="title" :items="items" />
    <AdministradoExpedienteDetalleEditDocumentModal></AdministradoExpedienteDetalleEditDocumentModal>
    <AdministradoExpedienteDetalleDeleteDocumentModal></AdministradoExpedienteDetalleDeleteDocumentModal>

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
            <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
              <b-form @submit.prevent="handleSubmit(onSubmitForm)">
                <div class="row">
                  <div class="col-md-6">
                    <ValidationProvider
                      rules="required|alpha_num_spaces"
                      name="Nombre"
                      v-slot="{ validated, valid, errors }"
                    >
                      <b-form-group label="Nombre comercial:" class="mb-3">
                        <b-form-input
                          type="text"
                          v-model="item.nombre_comercial"
                          :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                        ></b-form-input>
                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>
                    <ValidationProvider
                      rules="required|alpha_num_spaces"
                      name="Dirección"
                      v-slot="{ validated, valid, errors }"
                    >
                      <b-form-group label="Dirección comercial:" class="mb-3">
                        <b-form-input
                          type="text"
                          v-model="item.direccion"
                          :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                        ></b-form-input>
                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>
                    <ValidationProvider
                      rules="required|numeric|integer"
                      name="Área"
                      v-slot="{ validated, valid, errors }"
                    >
                      <b-form-group label="Área (m²) comercial" class="mb-3">
                        <b-form-input
                          type="number"
                          v-model="item.area"
                          :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                        ></b-form-input>
                        <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </ValidationProvider>
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
                    <div class="mb-3" v-if="item.recibo_pago">
                      <label class="form-label">Recibo de Pago:</label>
                      <p class="text-muted m-0">
                        <a
                          href="javascript:void(0);"
                          class="text-decoration"
                          @click.stop="$downloadFile(item.recibo_pago)"
                        >
                          <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                        </a>
                      </p>
                    </div>
                    <div class="mb-3" v-if="item.archivo_solicitud_ht">
                      <label class="form-label">Anexo Nro. 5:</label>
                      <p class="text-muted m-0">
                        <a
                          href="javascript:void(0);"
                          class="text-decoration"
                          @click.stop="$downloadFile(item.archivo_solicitud_ht)"
                        >
                          <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                        </a>
                      </p>
                    </div>
                    <div class="mb-3" v-if="item.anexo10">
                      <label class="form-label">Informe de VAH:</label>
                      <p class="text-muted m-0">
                        <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(item.anexo10)">
                          <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row" v-if="checkStatusToEdit">
                  <div class="col-12">
                    <b-button type="submit" size="md" variant="primary">
                      <i class="fas fa-edit"></i> Actualizar
                    </b-button>
                  </div>
                </div>
              </b-form>
            </ValidationObserver>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning m-0">
              <ul class="m-0">
                <li>
                  Desglose y haga clic en el botón <b>Editar</b> ( <b><i class="uil uil-pen font-size-18"></i></b> )
                  para adjuntar sus documentos en <b>formato PDF</b> ( <b><i class="fas fa-file-pdf"></i></b> )
                </li>
                <li>Limite de tamaño por archivo es de <b>10 MB</b> (10 megabytes)</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Actualizar Documentos</h2>
          </div>
          <div class="card-body">
            <div class="custom-accordion">
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.documentos_principales"
                :visible="visiblePrincipales"
                :numero="`1`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_arquitectura"
                :visible="visibleArquitectura"
                :numero="`2`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.plans_fabrica_inscrita"
                :visible="visibleFabrica"
                :numero="`3`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_remodelacion"
                :visible="visibleRemodelacion"
                :numero="`4`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_ampliacion"
                :visible="visibleAmpliacion"
                :numero="`5`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_rutas_evacuacion"
                :visible="visibleEvacuacion"
                :numero="`6`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
              <AdministradoExpedienteDetalleDocumentos
                :id_expediente="id_expediente"
                :categoria="item.expedienteadhoc_archivo.planos_senalizacion"
                :visible="visibleSenalizacion"
                :numero="`7`"
                :estado_expediente="item.estado_expediente_nombre"
              ></AdministradoExpedienteDetalleDocumentos>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
