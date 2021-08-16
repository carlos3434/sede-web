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
      default: 'Subir Documento'
    }
  },
  data() {
    return {
      modalId: 'modal-upload',
      openModalEvent: 'open-upload-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/documentos/',
      msgSuccess: 'Documento subido exitosamente!!!',
      item: {
        id: null,
        title: '',
        file: null,
        required: null
      },
      user_id: null,
      fileToUpload: null,
      isNewFile: false
    }
  },
  computed: {
    apiUrl: function () {
      return this.apiUrlPartial + this.user_id
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
      this.user_id = item.user_id
      this.item.id = item.id
      this.item.title = item.title
      this.item.file = item.file
      this.item.required = item.required
      this.isNewFile = item.file ? false : true
    },
    resetFormValues() {
      // Resetting Values
      this.user_id = null
      this.item.id = null
      this.item.title = ''
      this.item.file = null
      this.item.required = null
      this.isNewFile = null
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

        let data = new FormData()
        data.append('_method', 'put')
        data.append(this.item.id, this.fileToUpload)

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
      <div class="alert alert-warning" role="alert">
        <p class="m-0">Limite de tamaño por archivo es de <b>3 MB</b> (3 megabytes)</p>
      </div>
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <div class="row">
            <div class="col-12">
              <ValidationProvider mode="eager" rules="required|max:3072" name="Archivo" v-slot="{ validate, errors }">
                <b-form-group :label="item.title + `:`" class="mb-3">
                  <input class="form-control" type="file" @change="handleFileChange($event) || validate($event)" />
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-paper-plane"></i> Subir Archivo
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
