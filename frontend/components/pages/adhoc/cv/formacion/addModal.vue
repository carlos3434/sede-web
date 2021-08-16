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
      default: 'Agregar Formación Académica'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-add-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/formaciones',
      msgSuccess: 'Formación Académica creada exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        especialidad: '',
        fecha_expedicion: '',
        ciudad: '',
        archivo_titulo: null,
        grado_id: '',
        institucion_id: ''
      },
      institucionSelected: null,
      gradoSelected: null,
      listGrados: [],
      listInstituciones: []
    }
  },
  watch: {
    institucionSelected: function (val) {
      this.item.institucion_id = val && val.id ? val.id : null
    },
    gradoSelected: function (val) {
      this.item.grado_id = val && val.id ? val.id : null
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
      this.item.especialidad = ''
      this.item.fecha_expedicion = ''
      this.item.ciudad = ''
      this.item.archivo_titulo = ''
      this.item.grado_id = ''
      this.item.institucion_id = ''
      this.institucionSelected = null
      this.gradoSelected = null
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
      await this.$axios.get('/listasParaFormacion').then((res) => {
        this.listGrados = res.data.grado_academicos || []
        this.listInstituciones = res.data.institutiones || []
      })
    },
    handleFileChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.item.archivo_titulo = files[0]
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="lg" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <ValidationProvider rules="required|alpha_num_spaces|max:120" name="Especialidad" v-slot="{ valid, errors }">
            <b-form-group label="Especialidad del grado académico:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.especialidad"
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
                placeholder="Elija una institución académica"
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
              <ValidationProvider rules="required" name="Grado" v-slot="{ valid, errors }">
                <b-form-group label="Grado académico:" class="mb-3">
                  <multiselect-c
                    :options="listGrados"
                    v-model="gradoSelected"
                    label="nombre"
                    track-by="id"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                    placeholder="Elija un grado académico"
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
              <ValidationProvider rules="required" name="Fecha" v-slot="{ valid, errors }">
                <b-form-group label="Fecha de expedición del título:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_expedicion"
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
              <ValidationProvider rules="required|alpha_num_spaces|max:80" name="Ciudad" v-slot="{ valid, errors }">
                <b-form-group label="Ciudad de la formación académica:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.ciudad"
                    :state="errors[0] ? false : valid ? true : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider rules="required|ext:pdf|size:3072" name="Archivo" v-slot="{ validate, errors }">
                <b-form-group label="Titulo_o_grado_academico.PDF:" class="mb-3">
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
