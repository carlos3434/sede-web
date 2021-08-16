<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Editar Usuario'
    }
  },
  data() {
    return {
      modalId: 'modal-edit',
      openModalEvent: 'open-edit-modal',
      refreshTableEvent: 'refresh-table',
      apiUrlPartial: '/users/',
      msgSuccess: 'Usuario actualizado exitosamente!!!',
      isProcessing: false,
      listaTipoDocumento: [],
      listaSexo: [],
      item: {
        id: null,
        nombres: '',
        tipo_documento_id: '',
        numero_documento: '',
        apellido_paterno: '',
        apellido_materno: '',
        sexo: '',
        telefono_fijo: '',
        celular: '',
        password: '',
        email: ''
      },
      tipoDocumentoSelected: null,
      sexoSelected: null
    }
  },
  watch: {
    tipoDocumentoSelected: function (val) {
      this.item.tipo_documento_id = val && val.id ? val.id : null
    },
    sexoSelected: function (val) {
      this.item.sexo = val && val.id  ? 1 : 0
    }
  },
  created() {
    this.$nuxt.$on(this.openModalEvent, (item, listaTipoDocumento , listaSexo) => {
      this.listaTipoDocumento = listaTipoDocumento
      this.listaSexo = listaSexo
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
      this.item.nombres = item.nombres
      this.item.tipo_documento_id = item.tipo_documento_id
      this.item.numero_documento = item.numero_documento
      this.item.apellido_paterno = item.apellido_paterno
      this.item.apellido_materno = item.apellido_materno
      this.item.sexo = item.sexo
      this.item.telefono_fijo = item.telefono_fijo
      this.item.celular = item.celular
      this.item.email = item.email

      this.setSelectedOptions()
    },
    setSelectedOptions() {
      this.tipoDocumentoSelected = this.listaTipoDocumento.find((i) => i.id == this.item.tipo_documento_id)
      this.sexoSelected = this.listaSexo.find((i) => i.id == this.item.sexo)
    },
    resetFormValues() {
      // Resetting Values
      this.item.id = ''
      this.item.nombres = ''
      this.item.tipo_documento_id = ''
      this.item.numero_documento = ''
      this.item.apellido_paterno = ''
      this.item.apellido_materno = ''
      this.item.sexo = ''
      this.item.telefono_fijo = ''
      this.item.celular = ''
      this.item.email = ''

      this.tipoDocumentoSelected = null
      this.sexoSelected = null
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
    <b-modal :id="modalId" :title="title" @ok="handleOk" @hidden="resetModal">
      <ValidationObserver ref="form" v-slot="{ handleSubmit }" @submit.prevent>
        <b-form @submit.prevent="handleSubmit(onSubmit)">

          <div class="row">
            <div class="col-12">

              <ValidationProvider
                mode="eager"
                rules="required|alpha_num_spaces"
                name="Nombre"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Nombres:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.nombres"
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
                rules="required|alpha_num_spaces"
                name="Apellido Paterno"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Apellido Paterno:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.apellido_paterno"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>

            </div>

            <div class="col-6">

              <ValidationProvider
                mode="eager"
                rules="required|alpha_num_spaces"
                name="Apellido Materno"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Apellido Materno:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.apellido_materno"
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
                rules="required"
                name="Tipo de Documento"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Tipo de Documento:" class="mb-3">
                  <multiselect-c
                    vid="tipo_documento_id"
                    :options="listaTipoDocumento"
                    v-model="tipoDocumentoSelected"
                    label="nombre"
                    track-by="id"
                    :class="errors[0] ? `is-invalid` : valid ? `is-valid` : ``"
                    placeholder="Elija un tipo de documento"
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
                rules="required|min:6"
                name="Documento"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Documento:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.numero_documento"
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
                mode="passive"
                rules="required"
                name="Género"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Género:" class="mb-3">
                  <multiselect-c
                    vid="sexo"
                    :options="listaSexo"
                    v-model="sexoSelected"
                    label="nombre"
                    track-by="id"
                    :class="validated && valid ? `is-valid` : errors[0] ? `is-invalid` : ``"
                    placeholder="Elija un género"
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
                name="Telefono"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Telefono:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.telefono_fijo"
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
                rules="required|alpha_num_spaces"
                name="Celular"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Celular:" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.celular"
                    :state="validated && valid ? true : errors[0] ? false : null"
                  ></b-form-input>
                  <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
              </ValidationProvider>
            </div>


            <div class="col-6">
              <ValidationProvider
                mode="eager"
                rules="required|email"
                name="Correo electrónico:"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Correo electrónico::" class="mb-3">
                  <b-form-input
                    type="text"
                    v-model="item.email"
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
                rules="min:8"
                name="Password"
                v-slot="{ validated, valid, errors }"
              >
                <b-form-group label="Password:" class="mb-3">
                  <b-form-input
                    type="password"
                    v-model="item.password" placeholder="•••••••"
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
