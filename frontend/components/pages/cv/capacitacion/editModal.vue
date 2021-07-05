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
      default: 'Editar Capacitación'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/capacitaciones/',
      msgSuccess: 'Capacitación actualizada exitosamente!!!',
      item: {
        id: null,
        nombre: '',
        fecha_inicio: '',
        fecha_termino: '',
        horas_lectivas: '',
        ciudad: '',
        tipo_capacitacion_id: '',
        institucion_id: '',
        certificado: null,
        certificado_anterior: null
      },
      institucionSelected: null,
      tipoCapacitacionSelected: null,
      listInstituciones: [],
      listTipoCapacitacion: [],
      isNewFile: false
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
    resetmodal() {
      this.resetFormValues()
    },
    showNotification(type, message) {
      this.$notify({ group: 'noti', type: type, text: message })
    },
    setItemValues(item) {
      this.item.id = item.id
      this.item.nombre = item.nombre
      this.item.fecha_inicio = item.fecha_inicio
      this.item.fecha_termino = item.fecha_termino
      this.item.horas_lectivas = item.horas_lectivas
      this.item.ciudad = item.ciudad
      this.item.tipo_capacitacion_id = item.tipo_capacitacion_id
      this.item.institucion_id = item.institucion_id
      this.item.certificado_anterior = item.certificado

      this.setSelectedOptions()
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
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
      this.isNewFile = false
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

        for (let key in this.item) {
          if (this.item[key]) {
            data.append(key, this.item[key])
          }
        }

        this.$axios
          .post(this.apiUrl, data)
          .then((res) => {
            this.showNotification('success', this.msgSuccess)
          })
          .finally(() => {
            this.refreshTable()
            this.hideModal()
          })
      })
    },
    setSelectedOptions() {
      this.institucionSelected = this.listInstituciones.find((i) => i.id == this.item.institucion_id)
      this.tipoCapacitacionSelected = this.listTipoCapacitacion.find((i) => i.id == this.item.tipo_capacitacion_id)
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
    },
    requestChangeFile() {
      this.isNewFile = !this.isNewFile
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="lg" @hidden="resetmodal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider
            mode="eager"
            rules="required|alpha_num_spaces"
            name="Nombre"
            v-slot="{ validated, valid, errors }"
          >
            <b-form-group label="Nombre de la capacitación:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.nombre"
                :state="validated && valid ? true : errors[0] ? false : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
          <ValidationProvider rules="required" name=" " v-slot="{ validated, valid, errors }">
            <b-form-group label="Institución académica:" class="mb-3">
              <multiselect-c
                :options="listInstituciones"
                v-model="institucionSelected"
                label="nombre"
                track-by="id"
                :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
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
              <ValidationProvider rules="required" name="Tipo" v-slot="{ validated, valid, errors }">
                <b-form-group label="Tipo de capacitación:" class="mb-3">
                  <multiselect-c
                    :options="listTipoCapacitacion"
                    v-model="tipoCapacitacionSelected"
                    label="nombre"
                    track-by="id"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
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
              <ValidationProvider
                mode="eager"
                rules="required|alpha_num_spaces"
                name="Ciudad"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Ciudad de la capacitación:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.ciudad"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <ValidationProvider
                mode="eager"
                rules="required|before_or_equal:@target_fecha_final"
                name="Fecha Inicio"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Fecha Inicio:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_inicio"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :disabled-date="(date) => date >= $moment().subtract(1, 'days')"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                  ></date-picker>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider
                mode="eager"
                vid="target_fecha_final"
                rules="required"
                name="Fecha Fin"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Fecha Final:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_termino"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :disabled-date="(date) => date >= $moment().subtract(1, 'days')"
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
              <ValidationProvider rules="required|numeric|integer" name="Horas" v-slot="{ validated, valid, errors }">
                <b-form-group label="Horas lectivas" class="mb-3">
                  <b-form-input
                    type="number"
                    v-model="item.horas_lectivas"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <template v-if="isNewFile">
                <ValidationProvider
                  mode="eager"
                  rules="required|ext:pdf|size:3072"
                  name="Archivo"
                  v-slot="{ validate, errors }"
                >
                  <b-form-group label="Certificado.PDF:" class="mb-3">
                    <input class="form-control" type="file" @change="handleFileChange($event) || validate($event)" />
                    <div class="invalid-feedback" style="display: block" v-show="errors.length">
                      {{ errors[0] }}
                    </div>
                  </b-form-group>
                </ValidationProvider>
              </template>
              <template v-else>
                <b-form-group label="Certificado.PDF:" class="mb-3">
                  <a :href="$config.filebaseurl + item.certificado_anterior" target="_blank" class="text-decoration">
                    <i class="uil uil-file-info-alt font-size-18"></i> Archivo adjunto
                  </a>
                  <button
                    class="btn btn-outline-danger btn-sm"
                    type="button"
                    @click="requestChangeFile"
                    v-b-tooltip.hover
                    title="Subir nuevo Archivo"
                    style="margin-left: 20px"
                  >
                    Cambiar
                  </button>
                </b-form-group>
              </template>
            </div>
          </div>
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-edit"></i> Actualizar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
