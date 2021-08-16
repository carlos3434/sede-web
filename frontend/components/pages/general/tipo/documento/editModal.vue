<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Editar Tipo de Documento'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/tipodocumento/',
      msgSuccess: 'Tipo de Documento actualizada exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        nombre: ''
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
    apiUrl: function () {
      return this.apiUrlPartial + this.item.id
    }
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
      this.item.id = item.id
      this.item.nombre = item.nombre
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
      this.item.nombre = ''
      this.isProcessing = false
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.onSubmit()
    },
    onSubmit() {
      if (!this.item.id) return

      this.$refs.form.validate().then((success) => {
        if (!success) {
          return
        }

        this.isProcessing = true

        this.$axios
          .put(this.apiUrl, this.item)
          .then((res) => {
            this.$notify({ type: 'success', text: this.msgSuccess })
          })
          .finally(() => {
            this.refreshTable()
            this.hideModal()
          })
      })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider
            mode="eager"
            rules="required|alpha_num_spaces"
            name="Nombre"
            v-slot="{ validated, valid, errors }"
          >
            <b-form-group label="Nombre:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.nombre"
                :state="validated && valid ? true : errors[0] ? false : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()" :disabled="isProcessing">
          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
          <i class="fas fa-edit" v-show="!isProcessing"></i> Actualizar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
