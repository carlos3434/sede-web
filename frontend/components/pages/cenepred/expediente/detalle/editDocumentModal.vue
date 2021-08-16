<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Enviar Revisión'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlRevision: '/revision',
      msgSuccess: 'Revisión enviado exitosamente!!!',
      isProcessing: false,
      revision: {
        estado_revision_id: null,
        expedienteadhoc_archivo_id: null,
        observacion: ''
      },
      item: {
        id: null,
        id_expediente: null,
        nombre_archivo: '',
        slug_archivo: '',
        valor_archivo: ''
      },
      listEstadoRevision: [],
      estadoRevisionSelected: null,
      estado_observado: 1 // Usar ID del estado observado, para mostrar el textarea
    }
  },
  watch: {
    estadoRevisionSelected: function (val) {
      this.revision.estado_revision_id = val && val.id ? val.id : null
    },
    'revision.observacion': function (val) {
      val = val ? val : ' '
    }
  },
  mounted() {
    this.loadSelectOptions()
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
  methods: {
    refreshTable() {
      this.$nuxt.$emit(this.refreshTableEvent)
    },
    showModal() {
      this.$bvModal.show(this.modalId)
    },
    hideModal() {
      this.$bvModal.hide(this.modalId)
    },
    resetModal() {
      this.resetFormValues()
    },
    setItemValues(item) {
      this.item.id = item.id_archivo
      this.item.id_expediente = item.id_expediente
      this.item.nombre_archivo = item.nombre_archivo
      this.item.slug_archivo = item.slug_archivo
      this.item.valor_archivo = item.valor_archivo
      this.revision.expedienteadhoc_archivo_id = item.expedienteadhoc_archivo_id
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = null
      this.item.id_expediente = null
      this.item.nombre_archivo = ''
      this.item.slug_archivo = ''
      this.item.valor_archivo = ''
      this.isProcessing = false

      this.revision.estado_revision_id = null
      this.revision.expedienteadhoc_archivo_id = null
      this.revision.observacion = ''

      this.estadoRevisionSelected = null
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.onSubmit()
    },
    onSubmit() {
      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }

        if (!this.revision.observacion) delete this.revision.observacion

        this.isProcessing = true

        this.$axios
          .post(this.apiUrlRevision, this.revision)
          .then((res) => {
            this.$notify({ type: 'success', text: this.msgSuccess })
          })
          .finally(() => {
            this.refreshTable()
            this.hideModal()
          })
      })
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaEntregaExpediente').then((res) => {
        // this.listAcreditaciones = res.data.acreditaciones || []
        // this.listEstadoExpediente = res.data.estado_expediente || []
        this.listEstadoRevision = res.data.estado_revision || []
      })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="md" @hidden="resetModal">
      <template v-if="revision.estado_revision_id == estado_observado">
        <b-alert variant="warning" show>
          <p class="m-0">Se enviará un correo al usuario administrado, informándole sobre el estado de este archivo.</p>
        </b-alert>
      </template>
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <b-form-group label="Documento:" class="mb-3">
            <p class="m-0">{{ item.nombre_archivo }}</p>
          </b-form-group>
          <ValidationProvider rules="required" name="Estado" v-slot="{ validated, valid, errors }">
            <b-form-group label="Estado:" class="mb-3">
              <multiselect-c
                :options="listEstadoRevision"
                v-model="estadoRevisionSelected"
                label="nombre"
                track-by="id"
                :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                placeholder="Elija un estado"
              >
                <span slot="noResult">Oops! No se encontraron elementos.</span>
                <span slot="noOptions">Lista vacia.</span>
              </multiselect-c>
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
          <template v-if="revision.estado_revision_id == estado_observado">
            <ValidationProvider rules="required" name="Observación" v-slot="{ validated, valid, errors }">
              <b-form-group label="Observación:" class="mb-3">
                <b-form-textarea
                  id="textarea"
                  v-model="revision.observacion"
                  placeholder="Escriba alguna observación..."
                  rows="2"
                  max-rows="3"
                  :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                ></b-form-textarea>
                <div class="invalid-feedback" style="display: block" v-show="errors.length">
                  {{ errors[0] }}
                </div>
              </b-form-group>
            </ValidationProvider>
          </template>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()" :disabled="isProcessing">
          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
          <i class="fas fa-paper-plane" v-show="!isProcessing"></i> Enviar Revisión
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
