<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Entrega Expediente AdHoc'
    }
  },
  data() {
    return {
      modalId: 'modal-entrega',
      openModalEvent: 'open-entrega-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlEntregaExpediente: '/entregaexpediente',
      msgSuccess: 'Entrega de expediente realizado exitosamente!!!',
      entrega: {
        acreditacion_id: null,
        expediente_adhoc_id: null
      },
      item: {
        id_expediente: null
      },
      listAcreditaciones: [],
      acreditadoSelected: null
    }
  },
  watch: {
    acreditadoSelected: function (val) {
      this.entrega.acreditacion_id = val && val.acreditacion_id ? val.acreditacion_id : null
    }
  },
  computed: {
    cenepred_fullname: function () {
      let name = ''
      name += this.$auth.user.nombres ? '' + this.$auth.user.nombres : ''
      name += this.$auth.user.apellido_paterno ? ' ' + this.$auth.user.apellido_paterno : ''
      name += this.$auth.user.apellido_materno ? ' ' + this.$auth.user.apellido_materno : ''
      return name
    }
  },
  mounted() {
    this.loadSelectOptions()
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (item) => {
      if (item.isValidEntregaExpediente) {
        this.setItemValues(item)
        this.showModal()
      } else {
        this.hideModal()
      }
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
      this.item.id_expediente = item.id
      this.entrega.expediente_adhoc_id = item.id
    },
    resetFormValues() {
      // Resetting Values
      this.item.id_expediente = null
      this.acreditadoSelected = null
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
          .post(this.apiUrlEntregaExpediente, this.entrega)
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
        this.listAcreditaciones = res.data.acreditaciones || []
        // this.listEstadoExpediente = res.data.estado_expediente || []
        // this.listEstadoRevision = res.data.estado_revision || []
      })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="md" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <b-form-group label="Usuario Revisor (cenepred):" class="mb-3">
            <p class="m-0">{{ cenepred_fullname }}</p>
          </b-form-group>
          <ValidationProvider rules="required" name="Verificador" v-slot="{ validated, valid, errors }">
            <b-form-group label="Asignar Verificador:" class="mb-3">
              <multiselect-c
                :options="listAcreditaciones"
                v-model="acreditadoSelected"
                label="usuario_nombres"
                track-by="acreditacion_id"
                :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                placeholder="Elija un usuario acreditado"
              >
                <span slot="noResult">Oops! No se encontraron elementos.</span>
                <span slot="noOptions">Lista vacia.</span>
              </multiselect-c>
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-handshake"></i> Entregar Expediente
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
