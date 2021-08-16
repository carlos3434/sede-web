<script>
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import 'vue2-datepicker/locale/es'

export default {
  components: {
    DatePicker
  },
  props: {
    title: {
      type: String,
      default: 'Subir Archivo'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/expedienteadhoc/',
      msgSuccess: 'Archivo subido exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        id_expediente: null,
        nombre_archivo: '',
        slug_archivo: '',
        valor_archivo: '',
        observacion: ''
      },
      fileToUpload: null,
      isNewFile: false
    }
  },
  computed: {
    apiUrl: function () {
      return this.apiUrlPartial + this.item.id_expediente
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
      this.item.observacion = item.observacion
      this.isNewFile = item.valor_archivo ? false : true
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = null
      this.item.id_expediente = null
      this.item.nombre_archivo = ''
      this.item.slug_archivo = ''
      this.item.valor_archivo = ''
      this.item.observacion = ''
      this.fileToUpload = null
      this.isNewFile = false
      this.isProcessing = false
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

        this.isProcessing = true

        let data = new FormData()
        data.append('_method', 'put')
        data.append('archivo[0][id]', this.item.id)
        data.append('archivo[0][valor]', this.fileToUpload)

        this.$axios
          .post(this.apiUrl, data)
          .then((res) => {
            this.$notify({ type: 'success', text: this.msgSuccess })
          })
          .finally(() => {
            this.refreshTable()
            this.hideModal()
          })
      })
    },
    handleFileChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.fileToUpload = files[0]
    },
    requestChangeFile() {
      this.isNewFile = !this.isNewFile
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="md" @hidden="resetModal">
      <div class="alert alert-warning" role="alert" v-if="isNewFile">
        <ul style="margin: 0">
          <li>
            El documento deberá ser subido en <b>formato PDF</b> ( <b><i class="fas fa-file-pdf"></i></b> )
          </li>
          <li>Limite de tamaño por archivo es de <b>10 MB</b> (10 megabytes)</li>
        </ul>
      </div>
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <div class="row">
            <div class="col-12">
              <template v-if="isNewFile">
                <ValidationProvider
                  mode="eager"
                  rules="required|ext:pdf|size:11264"
                  name="Archivo"
                  v-slot="{ validate, errors }"
                >
                  <b-form-group :label="item.nombre_archivo + `:`" class="mb-3">
                    <input class="form-control" type="file" @change="handleFileChange($event) || validate($event)" />
                    <div class="invalid-feedback" style="display: block" v-show="errors.length">
                      {{ errors[0] }}
                    </div>
                  </b-form-group>
                </ValidationProvider>
              </template>
              <template v-else>
                <b-form-group :label="item.nombre_archivo + `:`" class="mb-3">
                  <a href="javascript:void(0);" class="text-decoration" @click.stop="$downloadFile(item.valor_archivo)">
                    <i class="uil uil-file-info-alt font-size-18"></i> Ver documento
                  </a>
                  <button
                    class="btn btn-outline-danger btn-sm"
                    type="button"
                    @click="requestChangeFile"
                    v-b-tooltip.hover
                    title="Subir nuevo archivo"
                    style="margin-left: 20px"
                  >
                    Cambiar
                  </button>
                </b-form-group>
              </template>

              <div class="mb-3" v-if="item.observacion">
                <label class="form-label">Observación:</label>
                <p class="text-muted m-0">
                  {{ item.observacion }}
                </p>
              </div>
            </div>
          </div>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()" :disabled="!isNewFile || isProcessing">
          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
          <i class="fas fa-paper-plane" v-show="!isProcessing"></i> Subir Archivo
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
