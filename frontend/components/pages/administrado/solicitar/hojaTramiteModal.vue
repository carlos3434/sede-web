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
      default: 'Solicitar Nº de Hoja de Trámite'
    }
  },
  data() {
    return {
      modalId: 'modal-solicitar-hoja-tramite',
      openModalEvent: 'open-solicitar-hoja-tramite-modal',
      refreshTableEvent: 'refresh-table',
      msgSuccess: 'Solicitud enviada exitosamente!!!',
      isProcessing: false,
      item: {
        numero_operacion: '',
        nombre_banco: '',
        agencia: '',
        fecha_operacion: '',
        monto: '',
        distrito_id: '',
        recibo_pago: '',
        archivo_solicitud_ht: ''
      },
      id_expediente: null,
      listDepartamento: [],
      listProvincia: [],
      listDistrito: [],
      provinciasFiltrado: [],
      distritosFiltrado: [],
      departamentoSelected: null,
      provinciaSelected: null,
      distritoSelected: null
    }
  },
  watch: {
    distritoSelected: function (val) {
      this.item.distrito_id = val && val.id ? val.id : null
    }
  },
  mounted() {
    this.loadSelectOptions()
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (item) => {
      this.id_expediente = item.id
      this.showModal()
    })
  },
  beforeDestroy() {
    this.$nuxt.$off(this.openModalEvent)
  },
  methods: {
    onChangeDepartamento(e) {
      this.distritoSelected = null
      this.provinciaSelected = null
      this.distritosFiltrado = []
      this.provinciasFiltrado = []

      if (!e) return

      this.provinciasFiltrado = this.listProvincia.filter((i) => i.departamento_id == e.id)
    },
    onChangeProvincia(e) {
      if (!e) return

      this.distritoSelected = null
      this.distritosFiltrado = this.listDistrito.filter((i) => i.provincia_id == e.id)
    },
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
      this.item.numero_operacion = ''
      this.item.nombre_banco = ''
      this.item.agencia = ''
      this.item.fecha_operacion = ''
      this.item.monto = ''
      this.item.distrito_id = ''
      this.item.recibo_pago = ''
      this.item.archivo_solicitud_ht = ''
      this.distritoSelected = null
      this.provinciaSelected = null
      this.departamentoSelected = null
      this.distritosFiltrado = []
      this.provinciasFiltrado = []
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
        let apiUrl = '/expedienteadhoc/' + this.id_expediente + '/solicitar_hoja_tramite'

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
    },
    handleReciboFileChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.item.recibo_pago = files[0]
    },
    handleAnexoFileChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.item.archivo_solicitud_ht = files[0]
    },
    async loadSelectOptions() {
      await this.$axios.get('/listasParaRegistro').then((res) => {
        this.listDepartamento = res.data.departamentos || []
        this.listProvincia = res.data.provincias || []
        this.listDistrito = res.data.distritos || []
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
          <b-form-group label="Mi correo electrónico personal:" class="mb-3">
            <b-form-input type="text" readonly :value="$auth.user ? $auth.user.email : ''"></b-form-input>
            <div class="form-text">Mesa de partes le responderá a este email.</div>
          </b-form-group>
          <ValidationProvider
            mode="eager"
            rules="required|ext:pdf|size:3072"
            name="Anexo"
            v-slot="{ validate, errors }"
          >
            <b-form-group label="Adjuntar Anexo Nº 5.PDF:" class="mb-3">
              <input class="form-control" type="file" @change="handleAnexoFileChange($event) || validate($event)" />
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
          <ValidationProvider
            mode="eager"
            rules="required|ext:pdf|size:3072"
            name="Recibo"
            v-slot="{ validate, errors }"
          >
            <b-form-group label="Adjuntar Recibo de Pago.PDF:" class="mb-3">
              <input class="form-control" type="file" @change="handleReciboFileChange($event) || validate($event)" />
              <div class="invalid-feedback" style="display: block" v-show="errors.length">
                {{ errors[0] }}
              </div>
            </b-form-group>
          </ValidationProvider>
          <div class="row">
            <div class="col-6">
              <ValidationProvider rules="required|alpha_num_spaces" name="Banco" v-slot="{ validated, valid, errors }">
                <b-form-group label="Nombre del Banco:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.nombre_banco"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider
                rules="required|alpha_num_spaces"
                name="Agencia"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Nombre de la Agencia:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.agencia"
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
                rules="required|alpha_num_spaces"
                name="Nro Operación"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Número de Operación:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.numero_operacion"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider rules="required" name="Fecha Operación" v-slot="{ validated, valid, errors }">
                <b-form-group label="Fecha de Operación:" class="mb-3">
                  <date-picker
                    v-model="item.fecha_operacion"
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
              <ValidationProvider rules="required|numeric|integer" name="Monto" v-slot="{ validated, valid, errors }">
                <b-form-group label="Monto:" class="mb-3">
                  <b-form-input
                    type="number"
                    v-model="item.monto"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <ValidationProvider rules="required" name="Departamento" v-slot="{ validated, valid, errors }">
                <b-form-group label="Departamento:" class="mb-3">
                  <multiselect-c
                    :options="listDepartamento"
                    v-model="departamentoSelected"
                    label="nombre"
                    track-by="id"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                    placeholder="Elija un departamento"
                    @input="onChangeDepartamento"
                  >
                    <span slot="noResult">Oops! No se encontraron elementos.</span>
                    <span slot="noOptions">Lista vacia.</span>
                  </multiselect-c>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
            <div class="col-6">
              <ValidationProvider rules="required" name="Provincia" v-slot="{ validated, valid, errors }">
                <b-form-group label="Provincia:" class="mb-3">
                  <multiselect-c
                    :options="provinciasFiltrado"
                    v-model="provinciaSelected"
                    label="nombre"
                    track-by="id"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                    placeholder="Elija un provincia"
                    @input="onChangeProvincia"
                  >
                    <span slot="noResult">Oops! No se encontraron elementos.</span>
                    <span slot="noOptions">Lista vacia.</span>
                  </multiselect-c>
                  <div class="invalid-feedback" style="display: block" v-show="errors.length">
                    {{ errors[0] }}
                  </div>
                </b-form-group>
              </ValidationProvider>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <ValidationProvider rules="required" name="Distrito" v-slot="{ validated, valid, errors }">
                <b-form-group label="Distrito:" class="mb-3">
                  <multiselect-c
                    :options="distritosFiltrado"
                    v-model="distritoSelected"
                    label="nombre"
                    track-by="id"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                    placeholder="Elija un distrito"
                  >
                    <span slot="noResult">Oops! No se encontraron elementos.</span>
                    <span slot="noOptions">Lista vacia.</span>
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
