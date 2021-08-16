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
      default: 'Editar Convocatoria'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/convocatorias/',
      msgSuccess: 'Convocatoria actualizada exitosamente!!!',
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
    },
    resetModal() {
      this.resetFormValues()
    },
    setItemValues(item) {
      this.item.id = item.id
      this.item.nombre = item.nombre
      this.item.activo = item.activo
      this.item.fecha_inicio = item.fecha_inicio
      this.item.fecha_final = item.fecha_final
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
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
      if (!this.item.id) return

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

              <ValidationProvider
                mode="eager"
                rules="required|alpha_num_spaces"
                name="Nombre"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Nombre:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.nombre"
                    :state="validated && valid ? true : errors[0] ? false : null"
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
                    v-model="item.fecha_final"
                    :first-day-of-week="1"
                    lang="es"
                    format="YYYY-MM-DD"
                    valueType="format"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
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
          <i class="fas fa-edit" v-show="!isProcessing"></i> Actualizar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
