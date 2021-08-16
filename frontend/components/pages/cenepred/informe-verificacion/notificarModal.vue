<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Confirmación de notificación'
    }
  },
  data() {
    return {
      modalId: 'modal-notificar',
      openModalEvent: 'open-notificar-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/notificaciones/',
      msgSuccess: 'Notificación enviada exitosamente!!!',
      item: {
        id: null,
        text: ''
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
      this.resetFormValues()
    },
    setItemValues(item) {
      this.item.id = item.diligencia_id
      this.item.text = item.administrado_full_name
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = null
      this.item.text = ''
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.onSubmit()
    },
    onSubmit() {
      if (!this.item.id) return

      this.$axios
        .post(this.apiUrl)
        .then((res) => {
          this.$notify({ type: 'success', text: this.msgSuccess })
        })
        .finally(() => {
          this.refreshTable()
          this.hideModal()
        })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" @hidden="hideModal">
      <p>¿Está seguro que desea notificar al siguiente usuario administrado?</p>
      <p>
        <b>{{ item.text }}</b>
      </p>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar </b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-paper-plane"></i> Si, notificar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
