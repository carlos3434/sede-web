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
      default: 'Solicitar Verificación AdHoc'
    }
  },
  data() {
    return {
      modalId: 'modal-solicitar-verificacion',
      openModalEvent: 'open-solicitar-verificacion-modal',
      refreshTableEvent: 'refresh-table',
      msgSuccess: 'Solicitud enviada exitosamente!!!',
      isProcessing: false,
      item: {
        ht: ''
      },
      nombre_comercial: null,
      estadisticas: {
        completados: 0,
        total: 0
      },
      id_expediente: null
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
      this.id_expediente = item.id
      this.nombre_comercial = item.nombre_comercial
      this.estadisticas.completados = item.estadisticas.completados
      this.estadisticas.total = item.estadisticas.total
    },
    resetFormValues() {
      // Resetting Values
      this.id_expediente = ''
      this.nombre_comercial = ''
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

        for (let key in this.item) {
          data.append(key, this.item[key])
        }

        let apiUrl = '/expedienteadhoc/' + this.id_expediente + '/solicitar_verificacion_adhoc'

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
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="md" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <b-form-group label="Nombre Comercial:" class="mb-3">
            <b-form-input type="text" readonly :value="nombre_comercial"></b-form-input>
          </b-form-group>
          <b-form-group label="Documentos Cargados:" class="mb-3">
            <p style="margin: 0">
              <span class="text-info text-truncate mb-0">
                <b>{{ estadisticas.completados }}</b>
                de
                <b>{{ estadisticas.total }}</b> archivos
              </span>
            </p>
          </b-form-group>
          <ValidationProvider rules="required|numeric" name="Número" v-slot="{ validated, valid, errors }">
            <b-form-group label="Nº de Hoja de Trámite:" class="mb-3">
              <b-form-input
                type="number"
                v-model="item.ht"
                :state="validated && valid ? true : errors[0] ? false : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button
          type="submit"
          size="md"
          variant="primary"
          @click="ok()"
          v-b-tooltip.hover
          :title="title"
          :disabled="isProcessing"
        >
          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
          <i class="fas fa-paper-plane" v-show="!isProcessing"></i> Solicitar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
