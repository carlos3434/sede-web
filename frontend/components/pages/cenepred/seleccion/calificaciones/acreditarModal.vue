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
      default: 'Acreditación'
    }
  },
  data() {
    return {
      modalId: 'modal-acreditar',
      openModalEvent: 'open-acreditar-modal',
      refreshTableEvent: 'refresh-table',
      apiUrl: '/acreditaciones',
      msgSuccess: 'Acreditación guardada exitosamente!!!',
      user: {
        fullname: '',
        dni: '',
        sede: '',
        puntaje: ''
      },
      item: {
        calificacion_id: null,
        fecha_inicio: '',
        fecha_fin: ''
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
      this.user.fullname = `${item.usuario_nombres} ${item.usuario_apellido_paterno} ${item.usuario_apellido_materno}`
      this.user.dni = item.usuario_numero_documento
      this.user.sede = item.sede_registral_nombre
      this.user.puntaje = item.puntaje_total

      this.item.calificacion_id = item.id
    },
    resetFormValues() {
      // Resetting Values
      this.user.fullname = ''
      this.user.dni = ''
      this.user.sede = ''
      this.user.puntaje = ''
      this.item.calificacion_id = null
      this.item.fecha_inicio = ''
      this.item.fecha_fin = ''
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
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">DNI:</label>
                <p>{{ user.dni }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <p>{{ user.fullname }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Sede Registral:</label>
                <p>{{ user.sede }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label">Puntaje:</label>
                <p>{{ user.puntaje }}</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
              <ValidationProvider
                mode="eager"
                vid="target_fecha_final"
                rules="required"
                name="Fecha Fin"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Fecha Final:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_fin"
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
        </b-form>
      </ValidationObserver>
      <template #modal-footer="{ ok, cancel }">
        <b-button size="md" variant="link" @click="cancel()"> Cancelar</b-button>
        <b-button type="submit" size="md" variant="primary" @click="ok()">
          <i class="fas fa-award"></i> Acreditar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
