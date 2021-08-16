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
      default: 'Agregar Convocatoria'
    }
  },
  data() {
    return {
      modalId: 'modal-add',
      openModalEvent: 'open-add-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/convocatorias',
      msgSuccess: 'Convocatoria creada exitosamente!!!',
      isProcessing: false,
      item: {
        id: null,
        nombre: '',
        activo: false,
        fecha_inicio: '',
        fecha_final: ''
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
    },
    resetModal() {
      this.resetFormValues()
    },
    resetFormValues() {
      // Resetting Values
      this.item.nombre = ''
      this.item.activo = false
      this.item.fecha_inicio = ''
      this.item.fecha_final = ''
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
    }
  }
}
</script>

<template>
  <div>
    <b-modal :id="modalId" :title="title" @ok="handleOk" size="lg" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">


          <div class="row">
            <div class="col-6">
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
            </div>
            <div class="col-6">
              <ValidationProvider name="Activo" v-slot="{ valid, errors }">
                <b-form-group label="Activo:" class="mb-3">
                  <b-form-checkbox
                    value=true unchecked-value=false
                    v-model="item.activo"
                    :state="errors[0] ? false : valid ? true : null"
                  ></b-form-checkbox>
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
                    v-model="item.fecha_final"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                  ></date-picker>
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
