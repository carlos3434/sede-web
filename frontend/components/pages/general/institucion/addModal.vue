<script>
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import 'vue2-datepicker/locale/es'
import { countries } from '~/components/static/countries'

export default {
  components: {
    DatePicker
  },
  props: {
    title: {
      type: String,
      default: 'Agregar Institución'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-add-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/instituciones',
      msgSuccess: 'Institución creada exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        nombre: '',
        etiqueta: '',
        tipo_institucion_id: '',
        pais_id: ''
      },
      countries: countries,
      listTipoInstituciones: [],
      countrySelected: null,
      tipoInstitucionSelected: null
    }
  },
  watch: {
    tipoInstitucionSelected: function (val) {
      this.item.tipo_institucion_id = val && val.id ? val.id : null
    },
    countrySelected: function (val) {
      this.item.pais_id = val && val.id ? val.id : null
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
    },
    resetModal() {
      this.resetFormValues()
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = null
      this.item.nombre = ''
      this.item.etiqueta = ''
      this.item.tipo_institucion_id = ''
      this.item.pais_id = ''
      this.countrySelected = null
      this.tipoInstitucionSelected = null
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
          .post(this.apiUrl, this.item)
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
        this.listTipoInstituciones = res.data.institutiones || []
        this.listTipoInstituciones = [
          { id: 3, nombre: 'Gobierno Departamental' },
          { id: 2, nombre: 'Gobierno Local' },
          { id: 1, nombre: 'Institucion Academica' }
        ]
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
          <ValidationProvider rules="required|alpha_num_spaces" name="Nombre" v-slot="{ valid, errors }">
            <b-form-group label="Nombre:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.nombre"
                :state="errors[0] ? false : valid ? true : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
          <ValidationProvider rules="required|alpha_num_spaces" name="Etiqueta" v-slot="{ valid, errors }">
            <b-form-group label="Etiqueta:" class="mb-3">
              <b-form-input
                type="text"
                v-model="item.etiqueta"
                :state="errors[0] ? false : valid ? true : null"
              ></b-form-input>
              <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
          </ValidationProvider>
          <div class="row">
            <div class="col-6">
              <ValidationProvider rules="required" name="Tipo de Institución" v-slot="{ valid, errors }">
                <b-form-group label="Tipo de Institución:" class="mb-3">
                  <multiselect-c
                    :options="listTipoInstituciones"
                    v-model="tipoInstitucionSelected"
                    label="nombre"
                    track-by="id"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                    placeholder="Elija un tipo de institución"
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
              <ValidationProvider rules="required" name="Pais" v-slot="{ valid, errors }">
                <b-form-group label="Pais:" class="mb-3">
                  <multiselect-c
                    :options="countries"
                    v-model="countrySelected"
                    label="country"
                    track-by="id"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                    placeholder="Elija un pais"
                  >
                    <span slot="noResult">Oops! No se encontraron elementos.</span>
                  </multiselect-c>
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
