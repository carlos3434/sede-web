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
      default: 'Agregar Capacitación'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-add-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/capacitaciones',
      msgSuccess: 'Capacitación creada exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        nombre: '',
        fecha_inicio: '',
        fecha_termino: '',
        horas_lectivas: '',
        ciudad: '',
        tipo_capacitacion_id: '',
        institucion_id: '',
        certificado: null
      },
      institucionSelected: null,
      tipoCapacitacionSelected: null,
      listInstituciones: [],
      listTipoCapacitacion: []
    }
  },
  watch: {
    institucionSelected: function (val) {
      this.item.institucion_id = val && val.id ? val.id : null
    },
    tipoCapacitacionSelected: function (val) {
      this.item.tipo_capacitacion_id = val && val.id ? val.id : null
    }
  },
  mounted() {
    this.loadSelectOptions()
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, () => {
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
    resetFormValues() {
      // Resetting Values
      this.item.nombre = ''
      this.item.fecha_inicio = ''
      this.item.fecha_termino = ''
      this.item.horas_lectivas = ''
      this.item.ciudad = ''
      this.item.tipo_capacitacion_id = ''
      this.item.institucion_id = ''
      this.item.certificado = null
      this.institucionSelected = null
      this.tipoCapacitacionSelected = null
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

        for (let key in this.item) {
          data.append(key, this.item[key])
        }

        this.$axios
          .post(this.apiUrlPartial, data)
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
      await this.$axios.get('/listasParaCapacitacion').then((res) => {
        this.listInstituciones = res.data.institutiones || []
        this.listTipoCapacitacion = res.data.tipo_capacitacion || []
      })
    },
    handleFileChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.item.certificado = files[0]
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="lg" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider rules="required|alpha_num_spaces" name="Nombre" v-slot="{ valid, errors }">
            <b-form-group label="Nombre de la capacitación:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.nombre"
                :state="errors[0] ? false : valid ? true : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
          <ValidationProvider rules="required" name="Institución" v-slot="{ valid, errors }">
            <b-form-group label="Institución académica:" class="mb-3">
              <multiselect-c
                :options="listInstituciones"
                v-model="institucionSelected"
                label="nombre"
                track-by="id"
                :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                placeholder="Elija un institución académica"
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
              <ValidationProvider rules="required" name="Tipo" v-slot="{ valid, errors }">
                <b-form-group label="Tipo de capacitación:" class="mb-3">
                  <multiselect-c
                    :options="listTipoCapacitacion"
                    v-model="tipoCapacitacionSelected"
                    label="nombre"
                    track-by="id"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                    placeholder="Elija tipo de capacitación"
                  >
                    <span slot="noResult">Oops! No se encontraron elementos.</span>
                  </multiselect-c>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider rules="required|alpha_num_spaces" name="Ciudad" v-slot="{ valid, errors }">
                <b-form-group label="Ciudad de la capacitación:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.ciudad"
                    :state="errors[0] ? false : valid ? true : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <ValidationProvider
                rules="required|before_or_equal:@target_fecha_final"
                name="Fecha Inicio"
                v-slot="{ valid, errors }"
              >
                <b-form-group label="Fecha Inicio:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_inicio"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :disabled-date="(date) => date >= $moment().subtract(1, 'days')"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                  ></date-picker>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider vid="target_fecha_final" rules="required" name="Fecha Fin" v-slot="{ valid, errors }">
                <b-form-group label="Fecha Final:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_termino"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :disabled-date="(date) => date >= $moment().subtract(1, 'days')"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
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
              <ValidationProvider rules="required|numeric|integer" name="Horas" v-slot="{ valid, errors }">
                <b-form-group label="Horas lectivas" class="mb-3">
                  <b-form-input
                    type="number"
                    v-model="item.horas_lectivas"
                    :state="errors[0] ? false : valid ? true : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider rules="required|ext:pdf|size:3072" name="Certificado" v-slot="{ validate, errors }">
                <b-form-group label="Certificado.PDF:" class="mb-3">
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
        <b-button type="submit" size="md" variant="primary" @click="ok()" :disabled="isProcessing">
          <span class="spinner-border spinner-border-sm" v-show="isProcessing"></span>
          <i class="fas fa-paper-plane" v-show="!isProcessing"></i> Agregar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
