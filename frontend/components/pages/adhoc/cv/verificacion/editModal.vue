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
      default: 'Editar Verificación Realizada'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/verificaciones-realizadas/',
      msgSuccess: 'Verificación Realizada actualizado exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        nro_expediente: '',
        fecha: '',
        nro_informe: '',
        institucion_id: ''
      },
      institucionSelected: null,
      listInstituciones: []
    }
  },
  watch: {
    institucionSelected: function (val) {
      this.item.institucion_id = val && val.id ? val.id : null
    }
  },
  computed: {
    apiUrl: function () {
      return this.apiUrlPartial + this.item.id
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
      this.item.id = item.id
      this.item.nro_expediente = item.nro_expediente
      this.item.fecha = item.fecha
      this.item.nro_informe = item.nro_informe
      this.item.institucion_id = item.institucion_id

      this.setSelectedOptions()
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
      this.item.nro_expediente = ''
      this.item.fecha = ''
      this.item.nro_informe = ''
      this.item.institucion_id = ''
      this.institucionSelected = null
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
    },
    setSelectedOptions() {
      this.institucionSelected = this.listInstituciones.find((i) => i.id == this.item.institucion_id)
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaVerificacionRealizada').then((res) => {
        this.listInstituciones = res.data.institutiones || []
      })
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="lg" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider rules="required" name=" " v-slot="{ validated, valid, errors }">
            <b-form-group label="Gobierno distrital/provincial:" class="mb-3">
              <multiselect-c
                :options="listInstituciones"
                v-model="institucionSelected"
                label="nombre"
                track-by="id"
                :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                placeholder="Elija un gobierno distrital/provincial"
              >
                <span slot="noResult">Oops! No se encontraron elementos.</span>
              </multiselect-c>
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
          <div class="row">
            <div class="col-6">
              <ValidationProvider
                rules="required|alpha_num_spaces"
                name="Nro. de Expediente"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Número de expediente:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.nro_expediente"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider mode="eager" rules="required" name="Fecha" v-slot="{ validated, valid, errors }">
                <b-form-group label="Fecha de verificación:" class="mb-3">
                  <date-picker
                    v-model="item.fecha"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :disabled-date="(date) => date >= $moment()"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                  ></date-picker>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <ValidationProvider
                rules="required|alpha_num_spaces"
                name="Nro. de Informe"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Número de informe:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.nro_informe"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
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
