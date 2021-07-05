<script>
export default {
  name: 'ConfigAddModal',
  props: {
    title: {
      type: String,
      default: 'Agregar Configuración'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-add-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/configuraciones',
      msgSuccess: 'Configuración creada exitosamente!!!',
      item: {
        id: null,
        nombre: '',
        valor: ''
      }
    }
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, () => {
      this.showModal()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off(this.openModalEvent)
  },
  computed: {
    apiUrl: function () {
      return this.apiUrlPartial
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
      this.resetFormValues()
    },
    showNotification(type, message) {
      this.$notify({ group: 'noti', type: type, text: message })
    },
    resetFormValues() {
      // Resetting Values
      this.item.nombre = ''
      this.item.valor = ''
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

        this.$axios
          .post(this.apiUrl, this.item)
          .then((res) => {
            this.showNotification('success', this.msgSuccess)
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
    <b-modal :id="modalId" :title="title" @ok="handleOk" @hidden="hideModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }">
        <b-form @submit.prevent="handleSubmit(onSubmit)" @reset="hideModal">
          <ValidationProvider rules="required" name="Nombre" v-slot="{ valid, errors }">
            <b-form-group label="Nombre:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.nombre"
                :state="errors[0] ? false : valid ? true : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
          <ValidationProvider rules="required" name="Valor" v-slot="{ valid, errors }">
            <b-form-group label="Valor:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.valor"
                :state="errors[0] ? false : valid ? true : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-paper-plane"></i> Agregar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
