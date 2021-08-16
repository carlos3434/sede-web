<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Adjuntar Anexo Nº 8'
    }
  },
  data() {
    return {
      modalId: 'modal-anexo8',
      openModalEvent: 'open-anexo8-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/diligenciaverificador',
      msgSuccess: 'Anexo Nº 8 subido exitosamente!!!',
      item: {
        entrega_expediente_id: null,
        anexo_file: null
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
      this.item.entrega_expediente_id = item.id
    },
    resetFormValues() {
      // Resetting Values
      this.item.entrega_expediente_id = null
      this.item.anexo_file = null
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

        let apiUrl = this.apiUrlPartial

        let data = new FormData()
        data.append('_method', 'put')
        data.append('entrega_expediente_id', this.item.entrega_expediente_id)
        data.append('anexo8', this.item.anexo_file)

        this.$axios
          .post(apiUrl, data)
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
      this.item.anexo_file = files[0]
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="md" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <div class="row">
            <div class="col-12">
              <ValidationProvider rules="required|ext:pdf|size:3072" name="Anexo" v-slot="{ validate, errors }">
                <b-form-group label="Anexo Nº 8.PDF:" class="mb-3">
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
          <i class="fas fa-paper-plane"></i> Enviar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
