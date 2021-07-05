<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Eliminar Capacitación'
    }
  },
  data() {
    return {
      modalId: 'modal-delete',
      openModalEvent: 'open-delete-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/capacitaciones/',
      msgSuccess: 'Capacitación eliminada exitosamente!!!',
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
    showNotification(type, message) {
      this.$notify({ group: 'noti', type: type, text: message })
    },
    setItemValues(item) {
      this.item.id = item.id
      this.item.text = item.nombre
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
        .delete(this.apiUrl)
        .then((res) => {
          this.showNotification('success', this.msgSuccess)
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
      <p>¿Está seguro que desea eliminar esta capacitación?</p>
      <p>
        <b>{{ item.text }}</b>
      </p>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar </b-button>
        <b-button type="submit" size="md" variant="danger" @click="ok()"> Eliminar </b-button>
      </template>
    </b-modal>
  </div>
</template>
